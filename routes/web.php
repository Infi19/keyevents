<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\SubscriberController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('stud.home');
Route::get('/edit', [EditController::class, 'index'])->name('admin.edit');

// EVENT TITLE LINK
Route::get('/event/{id}', [EventController::class, 'show'])->name('stud.events.show');



Route::get('/dashboard', [EventController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// SETUP
// Display the form (GET request)
Route::get('/setup', function () {
    return view('admin.setup');
})->name('setup.form'); // Optional: Give the route a name for easier reference

// Handle form submission (POST request)
Route::post('/setup', [EventController::class, 'store'])->name('setup.submit');

// Subscription routes
Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');
Route::post('/unsubscribe', [SubscriberController::class, 'unsubscribe'])->name('unsubscribe');

require __DIR__.'/auth.php';
