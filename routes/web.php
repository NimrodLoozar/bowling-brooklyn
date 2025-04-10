<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ScoresController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaneController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/score', [ScoresController::class, 'index'])->name('scores');
    Route::get('/lanes', [LaneController::class, 'index'])->name('lanes');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
});

// Contacts
Route::resource('contacts', ContactController::class);

require __DIR__ . '/auth.php';
