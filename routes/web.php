<?php

use App\Http\Controllers\MagicLinkController;
use App\Http\Controllers\RsvpController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/info', 'info')->name('info');

Route::get('/login', [MagicLinkController::class, 'show'])->name('magic-link.show');
Route::post('/login', [MagicLinkController::class, 'send'])->name('magic-link.send');

Route::middleware('rsvp.token')->group(function () {
    Route::get('/rsvp/{token}', [RsvpController::class, 'show'])->name('rsvp.show');
    Route::post('/rsvp/{token}', [RsvpController::class, 'store'])->name('rsvp.store');
    Route::get('/rsvp/{token}/confirm', [RsvpController::class, 'confirm'])->name('rsvp.confirm');
});
