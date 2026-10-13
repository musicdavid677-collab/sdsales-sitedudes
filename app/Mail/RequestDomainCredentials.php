<?php

namespace App\Mail;

//use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Headers;
//use Illuminate\Contracts\Queue\ShouldQueue;


class RequestDomainCredentials extends Mailable //implements ShouldQueue
{
   // use Queueable, SerializesModels;
    use SerializesModels;

    private $id;
    private $name;
    private $dev_url;
    private $url;
    


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id,$name,$dev_url,$url)
    {
        $this->dev_url                          = $dev_url;

        $this->id=$id;
         $this->name=$name;
          $this->url=$url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject    = "SiteDudes.com: Domain Name Login Request";

        $from_email="service@sitedudes.com";
        $from_name="Site Dudes Inc.";
        $template = $this->subject($subject)
        ->from($from_email, $from_name)->view('customer.requestDomainCredentials',['id'=>$this->id,'name'=>$this->name,'dev_url'=>$this->dev_url,'url'=>$this->url]);

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
