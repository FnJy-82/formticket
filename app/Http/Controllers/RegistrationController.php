<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationConfirmation;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function create(): View
    {
        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:190', 'unique:registrations,email'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'birthdate' => ['required', 'date', 'before:today', 'after:1930-01-01'],
        ], [
            'email.unique' => 'This email is already registered.',
            'birthdate.before' => 'Birthdate must be in the past.',
            'password.confirmed' => 'The passwords do not match.',
        ]);

        $registration = Registration::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => $data['password'], // hashed by the model cast
            'birthdate' => $data['birthdate'],
            'confirmation_token' => Str::random(64),
            'confirmation_expires_at' => now()->addDays(7),
        ]);

        try {
            Mail::to($registration->email, $registration->full_name)
                ->send(new RegistrationConfirmation($registration));
        } catch (\Throwable $e) {
            Log::error('Failed to send registration email: ' . $e->getMessage());
            $registration->delete();

            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['email' => 'We could not send the confirmation email. Please check the address and try again.']);
        }

        return redirect()
            ->route('registration.success')
            ->with('registered_email', $registration->email)
            ->with('registered_name', $registration->full_name);
    }

    public function success(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('registered_email')) {
            return redirect()->route('registration.create');
        }

        return view('registered', [
            'email' => $request->session()->get('registered_email'),
            'name' => $request->session()->get('registered_name'),
        ]);
    }

    public function confirm(string $token): View
    {
        $registration = Registration::where('confirmation_token', $token)->first();

        if (! $registration) {
            return view('confirmed', ['state' => 'invalid']);
        }

        if ($registration->isConfirmed()) {
            return view('confirmed', ['state' => 'already', 'registration' => $registration]);
        }

        if ($registration->isExpired()) {
            return view('confirmed', ['state' => 'expired', 'registration' => $registration]);
        }

        $registration->update(['confirmed_at' => now()]);

        return view('confirmed', ['state' => 'ok', 'registration' => $registration]);
    }
}
