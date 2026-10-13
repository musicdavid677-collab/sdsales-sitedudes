<?php

namespace App\Mail;

//use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;


class SendSdContract extends Mailable //implements ShouldQueue
{
   // use Queueable, SerializesModels;
    use SerializesModels;
    private $rec;
//    private $invoice;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_to_pass_in_view,$lead,$products,$name_on_cc,$ccinfo,$cc_exp)
    {
        $this->rec                          = $data_to_pass_in_view;
        $this->lead                    = $lead;
        $this->products                   = $products;
        $this->name_on_cc = $name_on_cc;
        $this->ccinfo=$ccinfo;
        $this->cc_exp=$cc_exp;
    
    }       

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject    = "Invoice";
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
        $template = $this->subject($subject)->from($from_email, $from_name)->view('customer.generatecontract',['rec'=>$this->rec,'lead'=>$this->lead,'products'=>$this->products,'name_on_cc'=>$this->name_on_cc,'ccinfo'=>$this->ccinfo,'cc_exp'=>$this->cc_exp]);
    //    var_dump($template);exit();
        /*->with('rec', $this->rec)
        if($this->pdf_file_path)
        {
               $template->attach($this->pdf_file_path, [
                    'as'    => $this->invoice->number.'.pdf',
                    'mime'  => 'application/pdf',
                ]);
               
               $this->withSwiftMessage(function ($message) {
                    $message->pdf_file_path = $this->pdf_file_path;
                });

        }*/

       return $template;
//var_dump($template);
        
    }
}
