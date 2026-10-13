<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Remote Sales Registration - ' . $this->user->first_name . ' ' . $this->user->last_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-registration-notification',
            with: [
                'user' => $this->user,
                'approvalUrl' => route('admin.registrations.index'),
            ],
        );
    }
}
