@extends('layouts.app')

@section('title', 'Register')
@section('subtitle', 'Registration Form')

@section('content')
    @if ($errors->any() && ! $errors->hasAny(['full_name', 'email', 'password', 'birthdate']))
        <div class="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('registration.store') }}" id="regForm" novalidate>
        @csrf

        <div class="field">
            <label for="full_name">Full Name</label>
            <div class="control">
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                       placeholder="Enter your full name" autocomplete="name" required
                       class="{{ $errors->has('full_name') ? 'invalid' : '' }}">
            </div>
            @error('full_name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="email">Student Email</label>
            <div class="control">
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       placeholder="Enter your student email" autocomplete="email" required
                       class="{{ $errors->has('email') ? 'invalid' : '' }}">
            </div>
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="password">Password</label>
            <div class="control has-toggle">
                <input type="password" id="password" name="password"
                       placeholder="Create a secure password" autocomplete="new-password" required
                       class="{{ $errors->has('password') ? 'invalid' : '' }}">
                <button type="button" class="toggle" data-target="password">Show</button>
            </div>
            <div class="meter" id="meter" data-level="0"><span></span><span></span><span></span><span></span></div>
            @error('password')
                <div class="error">{{ $message }}</div>
            @else
                <div class="hint">At least 8 characters, with letters and numbers.</div>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Confirm Password</label>
            <div class="control has-toggle">
                <input type="password" id="password_confirmation" name="password_confirmation"
                       placeholder="Confirm your password" autocomplete="new-password" required>
                <button type="button" class="toggle" data-target="password_confirmation">Show</button>
            </div>
            <div class="error" id="matchError" hidden>Passwords do not match.</div>
        </div>

        <div class="field">
            <label for="birthdate">Birthdate</label>
            <div class="control">
                <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}"
                       max="{{ now()->subDay()->toDateString() }}" min="1930-01-01" required
                       class="{{ $errors->has('birthdate') ? 'invalid' : '' }}">
            </div>
            @error('birthdate') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn" id="submitBtn">Register for Cloud Computing 2025</button>
    </form>
@endsection

@push('scripts')
<script>
    // Show / hide password
    document.querySelectorAll('.toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = document.getElementById(btn.dataset.target);
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.textContent = show ? 'Hide' : 'Show';
        });
    });

    // Strength meter
    var pw = document.getElementById('password');
    var meter = document.getElementById('meter');
    pw.addEventListener('input', function () {
        var v = pw.value, score = 0;
        if (v.length >= 8) score++;
        if (/[a-z]/.test(v) && /[A-Z]/.test(v)) score++;
        if (/\d/.test(v)) score++;
        if (/[^A-Za-z0-9]/.test(v) || v.length >= 12) score++;
        meter.dataset.level = v ? score : 0;
    });

    // Match check
    var confirmInput = document.getElementById('password_confirmation');
    var matchError = document.getElementById('matchError');
    function checkMatch() {
        var bad = confirmInput.value !== '' && confirmInput.value !== pw.value;
        matchError.hidden = !bad;
        confirmInput.classList.toggle('invalid', bad);
        return !bad;
    }
    confirmInput.addEventListener('input', checkMatch);
    pw.addEventListener('input', checkMatch);

    // Prevent double submit
    document.getElementById('regForm').addEventListener('submit', function (e) {
        if (!checkMatch()) { e.preventDefault(); return; }
        var btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.textContent = 'Sending confirmation email…';
    });
</script>
@endpush
