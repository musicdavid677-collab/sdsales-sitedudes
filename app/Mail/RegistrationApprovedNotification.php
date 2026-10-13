<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class RegistrationApprovedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your SiteDudes Remote Sales Registration Has Been Approved',
        );
    }

    public function content(): Content
    {
        $verificationUrl = URL::temporarySignedRoute(
            'registration.verify',
            now()->addHours(24),
            ['user' => $this->user->id]
        );

        $passwordSetupUrl = URL::temporarySignedRoute(
            'registration.password',
            now()->addHours(48),
            ['user' => $this->user->id]
        );

        return new Content(
            markdown: 'emails.registration-approved',
            with: [
                'user' => $this->user,
                'verificationUrl' => $verificationUrl,
                'passwordSetupUrl' => $passwordSetupUrl,
            ],
        );
    }
}
