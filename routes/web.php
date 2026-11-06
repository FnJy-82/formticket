<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/register', [RegistrationController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('registration.store');
Route::get('/registered', [RegistrationController::class, 'success'])->name('registration.success');
Route::get('/confirm/{token}', [RegistrationController::class, 'confirm'])->name('registration.confirm');
