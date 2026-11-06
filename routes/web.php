<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookingController::class, 'create'])->name('booking.create');
Route::post('/book', [BookingController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('booking.store');
Route::get('/booked', [BookingController::class, 'success'])->name('booking.success');
Route::get('/confirm/{token}', [BookingController::class, 'confirm'])->name('booking.confirm');
