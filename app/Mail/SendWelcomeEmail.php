<?php

namespace App\Mail;

//use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Headers;
//use Illuminate\Contracts\Queue\ShouldQueue;


class SendWelcomeEmail extends Mailable //implements ShouldQueue
{
   // use Queueable, SerializesModels;
    use SerializesModels;

    private $id;
    private $name;
    private $products;
    private $url;
    private $signup_date;
    private $servives;
    private $recurring_fee;
    private $billing_date;
    private $invoicenumber;
    private $invoice_url;
    private $contract;
    


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id,$name,$products,$url,$signup_date,$services,$recurring_fee,$billing_date,$invoicenumber,$invoice_url,$contract)
    {
        $this->url                          = $url;

        $this->id=$id;
         $this->name=$name;
          $this->products=$products;
          $this->signup_date=$signup_date;
          $this->services=$services;
          $this->recurring_fee=$recurring_fee;
          $this->billing_date = $billing_date;
         $this->invoicenumber= $invoicenumber;
         $this->invoice_url=$invoice_url;
         $this->contract=$contract;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject    = "Welcome To Site Dudes";

        $from_email="service@sitedudes.com";
        $from_name="Site Dudes Inc.";
        $template = $this->subject($subject)
        ->from($from_email, $from_name)->view('customer.welcomeEmail',['id'=>$this->id,'name'=>$this->name,'products'=>$this->products,'url'=>$this->url,'signup_date'=>$this->signup_date,'services'=>$this->services,'recurring_fee'=>$this->recurring_fee,'billing_date'=>$this->billing_date ,'invoicenumber'=>$this->invoicenumber,'invoice_url'=>$this->invoice_url,'contract'=>$this->contract]);

//var_dump($template);exit();
       return $template;
    }
    /**
 * Get the message headers.
 */
/*public function headers(): Headers
{
return new Headers(
text: [
'X-xsMailingId' => $this->mailingId,
],
);
}*/
}
