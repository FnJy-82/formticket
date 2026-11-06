<?php

namespace App\Mail;

use App\Models\TicketBooking;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use SerializesModels;

    public function __construct(public TicketBooking $booking)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirm your tickets: ' . config('concert.name') . ' (' . $this->booking->booking_code . ')',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-confirmation',
            with: [
                'booking' => $this->booking,
                'confirmUrl' => route('booking.confirm', $this->booking->confirmation_token),
                'supportEmail' => config('mail.from.address'),
            ],
        );
    }
}
