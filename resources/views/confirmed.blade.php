@extends('layouts.app')

@section('title', 'Booking confirmation')

@section('content')
    <div class="status">
        @if ($state === 'ok' || $state === 'already')
            <div class="icon ok">&#10003;</div>
            <h2>{{ $state === 'ok' ? "You're going!" : 'Already confirmed' }}</h2>
            <p>
                @if ($state === 'ok')
                    Thanks, <strong>{{ $booking->full_name }}</strong>. Your tickets are secured.
                @else
                    <strong>{{ $booking->full_name }}</strong>, this booking was already confirmed on
                    {{ $booking->confirmed_at->format('F j, Y') }}.
                @endif
            </p>

            <div class="ticket">
                <div class="code">Booking code<b>{{ $booking->booking_code }}</b></div>
                <dl>
                    <dt>Ticket</dt><dd>{{ $booking->ticketLabel() }}</dd>
                    <dt>Quantity</dt><dd>{{ $booking->quantity }}</dd>
                    <dt>Total</dt><dd>{{ $booking->totalFormatted() }}</dd>
                    <dt>Date</dt><dd>{{ config('concert.date_label') }}</dd>
                    <dt>Venue</dt><dd>{{ config('concert.venue') }}</dd>
                </dl>
            </div>
            <p style="font-size:13px">Show your booking code at the entrance. See you at the show!</p>
        @elseif ($state === 'expired')
            <div class="icon warn">&#9203;</div>
            <h2>Link expired</h2>
            <p>This confirmation link is older than {{ config('concert.hold_days') }} days, so the booking was released. Please book again.</p>
        @else
            <div class="icon bad">&#10005;</div>
            <h2>Invalid link</h2>
            <p>We couldn't find a booking for this link. Check that you copied the full address from your email.</p>
        @endif

        <a href="{{ route('booking.create') }}" class="btn btn-link">Back to ticket booking</a>
    </div>
@endsection
