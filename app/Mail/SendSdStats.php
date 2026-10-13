<?php

namespace App\Mail;

//use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;


class SendSdStats extends Mailable //implements ShouldQueue
{
   // use Queueable, SerializesModels;
    use SerializesModels;
    private $total_failed;
     private $total_successful;
     private $total_emails;
     
//    private $invoice;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($total_failed,$total_successful,$total_emails,$email_list)
    {
        $this->total_failed                         = $total_failed;
        $this->total_successful                   = $total_successful;
        $this->total_emails                   = $total_emails;
        $this->email_list=$email_list;
    }       

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject    = "Invoice Email Stats";

        $from_email="service@sitedudes.com";
        $from_name="Site Dudes Inc.";
        $template = $this->subject($subject)->from($from_email, $from_name)->view('customer.emailstats',['total_failed'=>$this->total_failed,'total_successful'=>$this->total_successful,'total_emails'=>$this->total_emails, 'email_list'=>$this->email_list]);


       return $template;

    }
}
