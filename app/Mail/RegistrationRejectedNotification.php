<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationRejectedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user, public ?string $reason = null)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'SiteDudes Remote Sales Registration - Application Review',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.registration-rejected',
            with: [
                'user' => $this->user,
                'reason' => $this->reason,
            ],
        );
    }
}
