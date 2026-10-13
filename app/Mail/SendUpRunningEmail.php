<?php

namespace App\Mail;

//use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Headers;
//use Illuminate\Contracts\Queue\ShouldQueue;


class SendUpRunningEmail extends Mailable //implements ShouldQueue
{
   // use Queueable, SerializesModels;
    use SerializesModels;

    private $id;
    private $name;
    private $products;
    private $dev_url;
    private $signup_date;
    


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id,$name,$products,$dev_url,$signup_date)
    {
        $this->dev_url                          = $dev_url;

        $this->id=$id;
         $this->name=$name;
          $this->products=$products;
          $this->signup_date=$signup_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject    = "SiteDudes.com - Up And Running Email - ". $this->id;

        $from_email="service@sitedudes.com";
        $from_name="Site Dudes Inc.";
        $template = $this->subject($subject)
        ->from($from_email, $from_name)->view('customer.upRunningEmail',['id'=>$this->id,'name'=>$this->name,'products'=>$this->products,'dev_url'=>$this->dev_url,'signup_date'=>$this->signup_date]);

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
