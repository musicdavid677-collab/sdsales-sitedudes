<?php

namespace App\Mail;

//use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;


class SendSdInvoice extends Mailable //implements ShouldQueue
{
   // use Queueable, SerializesModels;
    use SerializesModels;
    private $rec;
   // private $pdf;
//    private $invoice;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_to_pass_in_view)
    {
        $this->rec                          = $data_to_pass_in_view;
        //$this->pdf=$pdf;
    
    }       

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject    = "SD Invoice";
        //$from_name  = config('constants.company_name');
    //    $from_email = config('constants.company_email');
    
        /*if($email = get_setting('email_template_invoice_sent_to_customer'))
        {
            $subject        = (isset($email->subject)) ? short_code_parser($email->subject, ['invoice_number' => $this->invoice->number ]) : $subject ;
            $from_name      = (isset($email->from_name)) ? $email->from_name : $from_name ;
            $from_email     = (isset($email->from_email_address)) ? $email->from_email_address : $from_email ;
        }       */
         
        $from_email="service@sitedudes.com";
        $from_name="Site Dudes Inc.";
        $template = $this->subject($subject)->from($from_email, $from_name)->view('customer.generateinvoice',['rec'=>$this->rec,'id'=>$this->rec['id'],'service'=>$this->rec['service'],'custom_service'=>$this->rec['custom_service'],'invoicenumber'=>$this->rec['invoicenumber'],'recamount'=>$this->rec['recamount'],'paid'=>$this->rec['paid'],'hst'=>$this->rec['hst'],'total'=>$this->rec['total'],'notes'=>$this->rec['notes'],'fee'=>$this->rec['fee'],'todays_date'=>$this->rec['todays_date'],'url'=>$this->rec['url'],'payment_type'=>$this->rec['payment_type']]);

        /*if($this->pdf)
        {
               $template->attach($this->pdf, [
                    'as'    => $this->rec['invoicenumber'].'.pdf',
                    'mime'  => 'application/pdf',
                ]);
               
               $this->withSwiftMessage(function ($message) {
                    $message->pdf = $this->pdf;
                });

        }*/

       return $template;
//var_dump($template);
        
    }
}
