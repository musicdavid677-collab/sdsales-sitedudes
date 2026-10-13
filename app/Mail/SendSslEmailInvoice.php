<?php

namespace App\Mail;

//use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Headers;
//use Illuminate\Contracts\Queue\ShouldQueue;


class SendSslEmailInvoice extends Mailable //implements ShouldQueue
{
   // use Queueable, SerializesModels;
    use SerializesModels;
    private $url;
    private $mailingId;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_to_pass_in_view,$mailingId)
    {
        $this->url                          = $data_to_pass_in_view;
        $this->mailingId=$mailingId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject    = "Site Dudes Yearly SSL Invoice";

        $from_email="service@sitedudes.com";
        $from_name="Site Dudes Inc.";
        $template = $this->subject($subject)
        ->from($from_email, $from_name)->view('customer.sslinvoice',['url'=>$this->url]);

//var_dump($template);exit();
       return $template;
    }
    /**
 * Get the message headers.
 */
public function headers(): Headers
{
return new Headers(
text: [
'X-xsMailingId' => $this->mailingId,
],
);
}
}
