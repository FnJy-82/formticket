<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Models\TicketBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function create(): View
    {
        return view('book');
    }

    public function store(Request $request): RedirectResponse
    {
        $tickets = config('concert.tickets');
        $max = (int) config('concert.max_per_booking');

        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:190'],
            'phone' => ['required', 'regex:/^[0-9+\-\s()]{8,20}$/'],
            'birthdate' => ['required', 'date', 'before:today', 'after:1930-01-01'],
            'ticket_type' => ['required', Rule::in(array_keys($tickets))],
            'quantity' => ['required', 'integer', 'min:1', "max:{$max}"],
        ], [
            'phone.regex' => 'Enter a valid phone number (digits, +, spaces or dashes).',
            'birthdate.before' => 'Birthdate must be in the past.',
            'ticket_type.in' => 'Please choose a ticket category.',
            'quantity.max' => "You can book up to {$max} tickets at once.",
        ]);

        $price = $tickets[$data['ticket_type']]['price'];

        $booking = TicketBooking::create([
            'booking_code' => $this->makeCode(),
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'birthdate' => $data['birthdate'],
            'ticket_type' => $data['ticket_type'],
            'quantity' => (int) $data['quantity'],
            'total_price' => $price * (int) $data['quantity'],
            'confirmation_token' => Str::random(64),
            'confirmation_expires_at' => now()->addDays((int) config('concert.hold_days')),
        ]);

        try {
            Mail::to($booking->email, $booking->full_name)->send(new BookingConfirmation($booking));
        } catch (\Throwable $e) {
            Log::error('Failed to send booking email: ' . $e->getMessage());
            $booking->delete();

            return back()
                ->withInput()
                ->withErrors(['email' => 'We could not send the confirmation email. Please check the address and try again.']);
        }

        $request->session()->put('booking_id', $booking->id);

        return redirect()->route('booking.success');
    }

    public function success(Request $request): View|RedirectResponse
    {
        $id = $request->session()->get('booking_id');
        $booking = $id ? TicketBooking::find($id) : null;

        if (! $booking) {
            return redirect()->route('booking.create');
        }

        return view('booked', ['booking' => $booking]);
    }

    public function confirm(string $token): View
    {
        $booking = TicketBooking::where('confirmation_token', $token)->first();

        if (! $booking) {
            return view('confirmed', ['state' => 'invalid']);
        }

        if ($booking->isConfirmed()) {
            return view('confirmed', ['state' => 'already', 'booking' => $booking]);
        }

        if ($booking->isExpired()) {
            return view('confirmed', ['state' => 'expired', 'booking' => $booking]);
        }

        $booking->update(['confirmed_at' => now()]);

        return view('confirmed', ['state' => 'ok', 'booking' => $booking]);
    }

    private function makeCode(): string
    {
        do {
            $code = 'NHL-' . strtoupper(Str::random(6));
        } while (TicketBooking::where('booking_code', $code)->exists());

        return $code;
    }
}
