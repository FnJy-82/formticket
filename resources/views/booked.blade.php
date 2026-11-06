@extends('layouts.app')

@section('title', 'Check your email')

@section('content')
    <div class="status">
        <div class="icon mail">&#9993;</div>
        <h2>Almost there, {{ \Illuminate\Support\Str::of($booking->full_name)->explode(' ')->first() }}!</h2>
        <p>
            We sent a confirmation message to <strong>{{ $booking->email }}</strong>.
            Click <strong>Confirm My Booking</strong> in that email within {{ config('concert.hold_days') }} days
            to secure your tickets.
        </p>

        <div class="ticket">
            <div class="code">Booking code<b>{{ $booking->booking_code }}</b></div>
            <dl>
                <dt>Ticket</dt><dd>{{ $booking->ticketLabel() }}</dd>
                <dt>Quantity</dt><dd>{{ $booking->quantity }}</dd>
                <dt>Total</dt><dd>{{ $booking->totalFormatted() }}</dd>
            </dl>
        </div>

        <p style="font-size:13px">Can't find the email? Check your spam folder.</p>
        <a href="{{ route('booking.create') }}" class="btn btn-link">Make another booking</a>
    </div>
@endsection
