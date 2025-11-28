<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Registration routes - accessible to everyone (logged in or not)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login routes - only for guests
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
        return redirect()->route('tickets.index');
    })->name('dashboard');
    
    // Tickets
    Route::resource('tickets', TicketController::class);
    Route::post('/tickets/{ticket}/messages', [MessageController::class, 'store'])->name('tickets.messages.store');
});
