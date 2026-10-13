<?php

namespace App\Http\Controllers;


use App\Models\Currency;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Project;
use App\Models\PaymentMode;
use App\Models\Services\Pdf;
use App\Models\PaymentForInvoices;
use App\Models\Customer;
use App\Models\Services\EncryptDecrypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Aws\Kms\KmsClient;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payment.index');
    }

    function paginate()
    {
        $query_key = Input::get('search');
        $search_key        = $query_key['value'];
        $customer_id        = Input::get('customer_id');
        $q                  = Payment::query();
        $query              = Payment::orderBy('id', 'DESC')
                                ->with(['invoice', 'payment_mode']);

        // If the user has permission to view only the ones that are created by himself;
        if(!check_perm('payments_view') && check_perm('invoices_view_own'))
        {
            $q->where(function($k){
                $k->where('entry_by', auth()->user()->id);
            });
            $query->where(function($k){
                $k->where('entry_by', auth()->user()->id);
            });                   
            
        }


        if($customer_id)
        {
            $q->whereHas('invoice', function ($q) use ($customer_id) {
                $q->where('invoices.customer_id', '=', $customer_id);
            });

            $query->whereHas('invoice', function ($q) use ($customer_id) {
                $q->where('invoices.customer_id', '=', $customer_id);
            });

        }

        $number_of_records  = $q->get()->count();




        if($search_key)
        {
            $query->where(function ($k) use ($search_key) {

                $k->where('number', 'like', $search_key.'%')
                ->orWhere('transaction_id', 'like', $search_key.'%')
                ->orWhere('amount', 'like', $search_key.'%')
                ->orWhereHas('invoice', function ($q) use ($search_key) {
                    $q->where('invoices.number', 'like', $search_key.'%');
                })
                ->orwhereHas('invoice',function ($q) use ($search_key){

                    $q->leftJoin('customers', 'invoices.customer_id', '=', 'customers.id')
                        ->where('customers.name', 'like', $search_key.'%');
                })
                ->orWhereHas('payment_mode', function ($q) use ($search_key) {
                    $q->where('payment_modes.name', 'like', $search_key.'%');
                });
            

            });
        }

        $recordsFiltered = $query->get()->count();
        $query->skip(Input::get('start'))->take(Input::get('length'));
        $data = $query->get();
//

        $rec = [];

        if (count($data) > 0)
        {
            foreach ($data as $key => $row)
            {

                $rec[] = array(
                    a_links(anchor_link($row->number, route('show_payment_page', $row->id )), [
                        [
                            'action_link' => route('edit_payment_page', $row->id), 
                            'action_text' => __('form.edit'), 'action_class' => '',
                            'permission' => 'payments_edit',
                        ],
                        [
                            'action_link' => route('delete_payment_page', $row->id), 
                            'action_text' => __('form.delete'), 'action_class' => 'delete_item',
                            'permission' => 'payments_delete',
                        ]
                    ]),
                    anchor_link($row->invoice->number, route('invoice_link', $row->invoice_id)),
                    $row->com_amount,
                    $row->transaction_id,
                    anchor_link($row->invoice->customer->name, route('view_customer_page', $row->invoice->customer->id)),
                    format_currency($row->amount, TRUE, $row->invoice->get_currency_symbol()),
                    sql2date($row->date),

                );

            }
        }


        $output = array(
            "draw" => intval(Input::get('draw')),
            "recordsTotal" => $number_of_records,
            "recordsFiltered" => $recordsFiltered,
            "data" => $rec
        );


        return response()->json($output);


    }


    public function show(Payment $payment)
    {       
        $payment->date = sql2date($payment->date);
        $data = [];
       return view('payment.show', compact('data'))->with('rec', $payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {   
    
        $data['payment_mode_id_list'] = PaymentMode::whereNull('inactive')
            ->orderBy('name','ASC')->pluck('name', 'id')->toArray();
        $payment->date = sql2date($payment->date);
       return view('payment.create', compact('data'))->with('rec', $payment);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'amount'            => 'required',
            'date'              => 'required',
            'payment_mode_id'   => 'required',
            'transaction_id'    => 'max:192',
        ]);


        if ($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $success = false;

        try {

            $payment                            = Payment::find($id);         

            if($payment)
            {
                $invoice                        = $payment->invoice;
                $previously_paid_amount         = $payment->amount;
                $new_payment_amount             = Input::get('amount');
                $applied_credits                = ($invoice->applied_credits) ? $invoice->applied_credits : 0;


                // Substracting the previously paid amount from Total Amount Paid, to find out the maximum amount that can be paid
                $maximum_amount_allowd_to_pay   = $invoice->total -(($invoice->amount_paid + $applied_credits ) - $previously_paid_amount) ;

                $validator->after(function ($validator)  use ($new_payment_amount , $maximum_amount_allowd_to_pay){
                
           
                    if ($new_payment_amount > $maximum_amount_allowd_to_pay) 
                    {
                        $validator->errors()->add('amount', __('form.over_received_amount'));
                    }
                    
                });

     

                if ($validator->fails())
                {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
                else
                {
                    
                    // Update Payments Table   
                    $payment->date              = date2sql(Input::get('date'));
                    $payment->amount            = $new_payment_amount ;                
                    $payment->payment_mode_id   = Input::get('payment_mode_id');
                    $payment->transaction_id    = Input::get('transaction_id');
                    $payment->note              = Input::get('note');
                  //  $comquery=DB::table('invoices')->select('id','status_id','created_by')->where('status_id',1)->where('created_by',$invoice->created_by)->count();
                    $today=date('Y-m-d');
        $edate=date('Y-m-d',strtotime('-12 months') );
        $comquery=DB::table('payments')->join('invoices','payments.invoice_id','=','invoices.id')->where('invoices.created_by', auth()->user()->id)->where('payments.created_at','>=',$edate)->where('payments.created_at','<=',$today)->count();
                    if($comquery>=0)
                    {
                    $compercent=0;
                    $comvalue=0;
                    if($comquery<=20)
                        $compercent=40; 
                         else if($comquery>=21 && $comquery<=40)
                        $compercent=48;  
                        else if($comquery>=41 && $comquery<=60)
                        $compercent=54; 
                        else if($comquery>60)
                        $compercent=60;

                        $comvalue=($compercent/100)*$invoice->total;
                        $payment->com_percent=$compercent;
                        $payment->com_value=$comvalue;

                }
                    $payment->save();


                   
                    // Update Invoice Table
                    $invoice->amount_paid = ($invoice->amount_paid - $previously_paid_amount) + $new_payment_amount ;

                    if(( $invoice->amount_paid + $invoice->applied_credits) >= $invoice->total)
                    {
                        $invoice->status_id = INVOICE_STATUS_PAID;
                    }
                    else
                    {
                        $invoice->status_id = INVOICE_STATUS_PARTIALLY_PAID;
                    }

                    $invoice->save();
            

                    // Log Activity
                    if($invoice->project_id)
                    {
                        $project        = Project::find($invoice->project_id);                   
                        $log_name       = LOG_NAME_PROJECT . $project->id;
                    }
                    else
                    {
                        $log_name       = LOG_NAME_DEFAULT;
                    }

                    $description = sprintf(__('form.act_updated'), __('form.payment')) ;

                    $value_to_store = anchor_link($payment->number, route('show_payment_page', $payment->id )) ;
                    log_activity($payment, trim($description), $value_to_store, $log_name);



                    DB::commit();
                    $success = true;
                }

            }




        } catch (\Exception  $e) {
            $success = false;

            DB::rollback();

            echo $e->getMessage();
            die();

        }

        if ($success)
        {
            session()->flash('message', __('form.success_update'));
            return  redirect()->route('payment_list');
        }
        else
        {
            session()->flash('message', __('form.could_not_perform_the_requested_action'));
            return redirect()->back();

        }

    }

    public function pricing()
    {

         return view('payment.pricing');
    }

    public function repcommission()
    {
        $today=date('Y-m-d');
        $edate=date('Y-m-d',strtotime('-12 months') );
        $comquery=DB::table('payments')->join('invoices','payments.invoice_id','=','invoices.id')->where('invoices.created_by', auth()->user()->id)->where('payments.created_at','>=',$edate)->where('payments.created_at','<=',$today)->get();
        $commission=array();
        foreach($comquery as $com)
        {
            $commission[]=array('number'=>$com->number,'date'=>$com->date,'percent'=>$com->com_percent,'amount'=>$com->com_amount);
        }
        //var_dump($commission);
         return view('payment.commission')->with('rec',$commission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment                        = Payment::with('invoice')->find($id);
        $invoice                        = $payment->invoice;

        DB::beginTransaction();
        $success = false;

        try {
            // Before deleting the payment rollback the amount in invoice and change the status
            $invoice->amount_paid       = $invoice->amount_paid - $payment->amount ;
            $invoice->status_id         = INVOICE_STATUS_UNPAID;
            $invoice->save();

            // Delete Payment
            $payment->delete();

             // Log Activity            
            $description                = sprintf(__('form.act_deleted'), __('form.payment'));
            $value_to_save              = $payment->number . "  ". __('form.for') . "  ".  __('form.invoice') . " ". $invoice->number;
            log_activity($payment, trim($description), $value_to_save);

            
            DB::commit();
            $success = true;
             session()->flash('message', __('form.success_delete'));

        } 
        catch (\Illuminate\Database\QueryException $e) {
           // Handle Integrity constraint violation
            DB::rollback();
            session()->flash('message', __('form.delete_not_possible_fk'));
        }
        catch (\Exception  $e) {
            $success = false;
            DB::rollback();
            session()->flash('message', __('form.could_not_perform_the_requested_action'));
        }

        if ($success)
        {           
            return  redirect()->route('payment_list');

        }
        else
        {            
            return redirect()->back();
        }


    }

    function download_receipt_pdf(Payment $payment)
    {

        if ($payment)
        {
            if($payment)
            {
                $data['page_title'] = $payment->number;

                $data['html']       = view('payment.print')->with('rec', $payment)->render();

                $html               = view('layouts.print.template', compact('data'))->render();

                $file_name = str_replace(" ", "_", trim($data['page_title']));
                
                $pdf = new Pdf();
                $pdf->download($html, $file_name);
            }
            else
            {
                abort(404);
            }

        }
    }

    function modes_index()
    {
        return view('payment.modes.index');
    }


    function modes_paginate()
    {
        $query_key = Input::get('search');
        $search_key        = $query_key['value'];
        
        $q                  = PaymentMode::whereNull('is_online');
        $query              = PaymentMode::whereNull('is_online')->orderBy('name', 'ASC');

        $number_of_records  = $q->get()->count();




        if($search_key)
        {
            $query->where('name', 'like', $search_key.'%');               
            
        }

        $recordsFiltered = $query->get()->count();
        $query->skip(Input::get('start'))->take(Input::get('length'));
        $data = $query->get();
//

        $rec = [];

        if (count($data) > 0)
        {
            foreach ($data as $key => $row)
            {
                $checked     = ($row->inactive) ? '' : 'checked';

                $rec[] = array(
                    a_links('<a class="edit_item" data-id="'.$row->id.'" href="#">'.$row->name.'</a>' , []),
                    $row->description,
                    ' <input '.$checked.' data-id="'.$row->id.'" class="tgl tgl-ios payment_mode_status" id="cb'.$row->id.'" type="checkbox"/><label class="tgl-btn" for="cb'.$row->id.'"></label>',
                    side_by_side_links($row->id, route('delete_payment_mode', $row->id) )

                );

            }
        }


        $output = array(
            "draw" => intval(Input::get('draw')),
            "recordsTotal" => $number_of_records,
            "recordsFiltered" => $recordsFiltered,
            "data" => $rec
        );


        return response()->json($output);


    }


    public function mode_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        =>  'required|unique:payment_modes',
            

        ]);

        if ($validator->fails()) 
        {
            return response()->json(['status' => 2 ,'errors'=>$validator->errors()]);
        }

        // Saving Data
        $obj                    = new PaymentMode();
        $obj->name              = $request->name;
        $obj->description       = $request->description;
        $obj->inactive          = ($request->inactive) ? $request->inactive : NULL ;
        
        $obj->save();

        return response()->json(['status' => 1]);
    }


    public function mode_edit(Request $request)
    {
        $obj = PaymentMode::find(Input::get('id'));

        if($obj)
        {
            return response()->json(['status' => 1, 'data' => $obj->toArray()]);
        }
        else
        {
            return response()->json(['status' => 2 ]);
        }

    }


    public function mode_update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'                =>  'required',
            'name' => [
                'required',
                Rule::unique('payment_modes')->ignore($request->id),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 2 ,'errors'=>$validator->errors()]);
        }

        // Saving Data
        $obj                    = PaymentMode::find($request->id);
        $obj->name              = $request->name;
        $obj->description       = $request->description;
        $obj->inactive          = ($request->inactive) ? $request->inactive : NULL ;
        $obj->save();

        return response()->json(['status' => 1]);

    }


    function change_mode_status(Request $request)
    {
        $inactive = Input::get('inactive');
        $status = ($inactive == 1) ? TRUE : NULL ;
        $rec = PaymentMode::where('id', Input::get('id'))->update(['inactive'=> $status]);

        if($rec)
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 2 ]);
        }
    }

    function mode_destroy(PaymentMode $mode)
    {

        $mode->delete();
        session()->flash('message', __('form.success_delete'));
        return redirect()->back();
    }

    function report_paginate()
    {
        $query_key          = Input::get('search');
        $search_key         = $query_key['value'];
       

        $currency_id        = Input::get('currency_id');
        $date_range         = Input::get('date_range');
        $date_from          = "";
        $date_to            = "";

        if($date_range)
        {
            list($date_from, $date_to)  = explode("-", $date_range);
            $date_from                  = str_replace('/', '-', trim($date_from) );
            $date_to                    = str_replace('/', '-', trim($date_to));
            $date_from                  = date2sql(trim($date_from));
            $date_to                    = date2sql(trim($date_to));
        }

        $q                  = Payment::query();
        $query              = Payment::orderBy('id', 'DESC')
                                ->with(['invoice', 'payment_mode']);
        
        if($date_from && $date_to )
        {
            $q->whereBetween('date', [$date_from, $date_to ]);
            $query->whereBetween('date', [$date_from, $date_to ]);
        } 


        if($currency_id)
        {
            $q->whereHas('invoice', function ($q) use ($currency_id) {
                $q->where('invoices.currency_id', '=', $currency_id);
            });

            $query->whereHas('invoice', function ($q) use ($currency_id) {
                $q->where('invoices.currency_id', '=', $currency_id);
            });

        }

        $number_of_records  = $q->get()->count();




        if($search_key)
        {
            $query->where('number', 'like', $search_key.'%')
                ->orWhere('transaction_id', 'like', $search_key.'%')
                ->orWhere('amount', 'like', $search_key.'%')

                ->orWhereHas('invoice', function ($q) use ($search_key) {
                    $q->where('invoices.number', 'like', $search_key.'%');
                })

                ->orwhereHas('invoice',function ($q) use ($search_key){

                    $q->leftJoin('customers', 'invoices.customer_id', '=', 'customers.id')
                        ->where('customers.name', 'like', $search_key.'%');
                })

                ->orWhereHas('payment_mode', function ($q) use ($search_key) {
                    $q->where('payment_modes.name', 'like', $search_key.'%');
                })
            ;
        }

        $recordsFiltered = $query->get()->count();
        $query->skip(Input::get('start'))->take(Input::get('length'));
        $data = $query->get();
//

        $rec = [];

        if (count($data) > 0)
        {
            $total = 0;
            $currency                   = Currency::find($currency_id);
            $currency_symbol            = (isset($currency->symbol)) ? $currency->symbol : NULL ;

            foreach ($data as $key => $row)
            {

                $rec[] = array(
                    a_links(anchor_link($row->number, route('edit_payment_page', $row->id )), [
                        ['action_link' => route('edit_payment_page', $row->id), 'action_text' => __('form.view'), 'action_class' => ''],
                        ['action_link' => route('delete_payment_page', $row->id), 'action_text' => __('form.delete'), 'action_class' => 'delete_item']
                    ]),
                    anchor_link($row->invoice->number, route('invoice_link', $row->invoice_id)),
                    $row->payment_mode->name,
                    $row->transaction_id,
                    anchor_link($row->invoice->customer->name, route('view_customer_page', $row->invoice->customer->id)),
                    format_currency($row->amount, TRUE, $currency_symbol ),
                    sql2date($row->date),

                    

                );
                
                $total   += $row->amount;
            }

            array_push($rec, [

               '<b>'. __('form.total_per_page'). '<b>',
                '',
                '',
                '',
                '',
                '<b>'.format_currency($total,TRUE, $currency_symbol). '<b>',
                '',
                

            ]);
        }


        $output = array(
            "draw" => intval(Input::get('draw')),
            "recordsTotal" => $number_of_records,
            "recordsFiltered" => $recordsFiltered,
            "data" => $rec
        );


        return response()->json($output);
    }	
	
	// TODO: Move this in CustomerController
    function paymentOptions(Request $request)
    {
    	$customer = \App\Models\Customer::withTrashed()
			->where([
				'id' => $request->id,
				'customer_id' => $request->get('customer_id')
			])
			->firstOrFail();
        
        //1 = credit-card
        if ($request->get('payment_type') === '1') {
    //    $passcode=DB::table('enckey')->first();
        
        //return $this->_viewPassCode($request);
//        if(check_perm('payments_view') && check_perm('payments_edit')){
        	return $this->_viewCreditCard($request, $customer);	        
    //    	}
        }
        
        //2 = cheque        
        if ($request->get('payment_type') === '2') {
        	return $this->_viewCheque($customer);        	
        }
    }
    
    private function _viewCreditCard($request, $customer)
    {
    	//if ($request->isMethod('post')) {
    	$passcode=DB::table('enckey')->first();
    		//$encryptDecrypt = new EncryptDecrypt($request->passcode);
    		$encryptDecrypt = new EncryptDecrypt($passcode->enckey);
    		//session()->put('passcode', $request->passcode);
    		session()->put('passcode', $passcode->enckey);
    		$ccinfo=DB::table('sd_pinfo')->where('sdnum',$customer->customer_id)->orderBy('id', 'DESC')->first();
    		//var_dump($ccinfo);exit();
    		$cc="";
    		$name_on_cc="";
    		$cc_exp="";
    		if($ccinfo && $ccinfo->pnum!=NULL && $ccinfo->pnum!=""){
    		/*$cc = $encryptDecrypt->decrypt($ccinfo->pnum);
    		$name_on_cc=$encryptDecrypt->decrypt($ccinfo->name);
    		$cc_exp=$encryptDecrypt->decrypt($ccinfo->exp);
    		//$request->session()->put('passcode',$request->passcode);*/
    		$kmsClient = new KmsClient(['version' => 'latest','region' => 'us-east-2']);

        try {
$cc = $kmsClient->decrypt(['CiphertextBlob' => base64_decode($ccinfo->pnum)]);
$cc=$cc["Plaintext"];
} catch (Exception $e) {
die("Decryption failed: " . $e->getMessage());
}try {
$name_on_cc = $kmsClient->decrypt(['CiphertextBlob' => base64_decode($ccinfo->name)]);
$name_on_cc=$name_on_cc["Plaintext"];
} catch (Exception $e) {
die("Decryption failed: " . $e->getMessage());
}try {
$cc_exp = $kmsClient->decrypt(['CiphertextBlob' => base64_decode($ccinfo->exp)]);
$cc_exp=$cc_exp["Plaintext"];
} catch (Exception $e) {
die("Decryption failed: " . $e->getMessage());
}
            if(Auth::user()->role_id==6){
    		$cc=substr($cc,-4);
    		$cc="xxxx xxxx xxxx ".$cc;
    		}
    		}
    		//$cc = $encryptDecrypt->decrypt($customer->credit_card);
    		
    		/*if (in_array($cc, ['Integrity check failed.', 'Ciphertext is too short.']) ) { //TODO: This is ugly checking. Change this
    			$request->session()->flash('failed', $cc);
    			
				return $this->_viewPassCode($request);
    		}*/
			
	$customer->credit_card = $cc;
	$customer->name_on_cc = $name_on_cc;
	$customer->cc_exp = $cc_exp;
	$data   = Customer::dropdowns();
		    return view('payment/_payment-options/1', [
		    	'customer' => $customer,
		    	'data' => $data
		    ]);
    //    }
        
    //    return $this->_viewPassCode($request);
    }
    
    private function _viewPassCode($request)
    {
    	return view('payment/passcode', [
    		'request' => $request
    	]);
    }
    
    private function _viewCheque($customer)
    {
    	return view('payment/_payment-options/2', [
        	'customer' => $customer
        ]);
    }
    
     public function add_ccinfo(Request $request, $clientId)
         {
         //var_dump($request);
         //var_dump($clientId);exit();
             $customerModel = Customer::withTrashed()->where('customer_id', $clientId);
             $request->merge(['first_bill_date' => date('Y-m-d H:i:s')]);
             $customerModel->create($request->except('_token'));
                        $customer = $customerModel->where('customer_id', $clientId)->first();
                         
                             return view('customer/sections/paymet-info', [
                                 'clientId' => $clientId,
                                    'customer' => $customer
                                         ]);
                                             }
}
