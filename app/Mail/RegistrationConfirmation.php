<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmation extends Mailable
{
    use SerializesModels;

    public function __construct(public Registration $registration)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirm your registration: ' . $this->registration->course,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-confirmation',
            with: [
                'registration' => $this->registration,
                'confirmUrl' => route('registration.confirm', $this->registration->confirmation_token),
                'supportEmail' => config('mail.from.address'),
            ],
        );
    }
}
