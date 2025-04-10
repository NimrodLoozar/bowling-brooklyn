<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScoresController;
use App\Http\Controllers\LaneController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;


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

    Route::get('scores', [ScoresController::class, 'index'])->name('scores.index');
    Route::get('lanes', [LaneController::class, 'index'])->name('lanes');
    
});

// Contacts
Route::resource('contacts', ContactController::class);

// reservations
Route::get('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

require __DIR__ . '/auth.php';
