<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScoresController;
use App\Http\Controllers\LaneController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified']) // Ensure authentication
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('scores', [ScoresController::class, 'index'])->name('scores.index');
    Route::get('lanes', [LaneController::class, 'index'])->name('lanes');
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations');
});

// Contacts
Route::resource('contacts', ContactController::class)->middleware('auth'); // Protect contacts routes

Route::resource('orders', OrderController::class)->middleware('auth'); // Protect orders routes

require __DIR__.'/auth.php';
