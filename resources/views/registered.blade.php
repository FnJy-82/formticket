@extends('layouts.app')

@section('title', 'Check your email')
@section('subtitle', 'Registration Received')

@section('content')
    <div class="status">
        <div class="icon mail">&#9993;</div>
        <h2>Check your inbox, {{ \Illuminate\Support\Str::of($name)->explode(' ')->first() }}!</h2>
        <p>
            We sent a confirmation message to <strong>{{ $email }}</strong>.
            Open it and click <strong>Confirm My Registration</strong> within 7 days to secure your spot.
        </p>
        <p style="font-size:13px">Can't find it? Check your spam folder.</p>
        <a href="{{ route('registration.create') }}" class="btn btn-link">Back to form</a>
    </div>
@endsection
