@extends('layouts.app')

@section('title', 'Confirmation')
@section('subtitle', 'Registration Confirmation')

@section('content')
    <div class="status">
        @if ($state === 'ok')
            <div class="icon ok">&#10003;</div>
            <h2>You're confirmed!</h2>
            <p>
                Thanks, <strong>{{ $registration->full_name }}</strong>. Your spot in
                <strong>{{ $registration->course }}</strong> is secured. See you in class!
            </p>
        @elseif ($state === 'already')
            <div class="icon ok">&#10003;</div>
            <h2>Already confirmed</h2>
            <p>
                <strong>{{ $registration->full_name }}</strong>, your registration was already confirmed
                on {{ $registration->confirmed_at->format('F j, Y') }}. Nothing more to do.
            </p>
        @elseif ($state === 'expired')
            <div class="icon warn">&#9203;</div>
            <h2>Link expired</h2>
            <p>This confirmation link is older than 7 days. Please contact the course support team to get a new one.</p>
        @else
            <div class="icon bad">&#10005;</div>
            <h2>Invalid link</h2>
            <p>We couldn't find a registration for this link. Check that you copied the full address from your email.</p>
        @endif

        <a href="{{ route('registration.create') }}" class="btn btn-link">Back to registration</a>
    </div>
@endsection
