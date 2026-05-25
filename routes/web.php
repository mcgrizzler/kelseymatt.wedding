<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\RsvpController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/details', 'details')->name('details');

Route::get('/rsvp', [RsvpController::class, 'create'])->name('rsvp.create');
Route::post('/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');

// Private RSVP dashboard
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });
});
