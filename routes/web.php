<?php

use Illuminate\Support\Facades\Route;

// Frontend-only routes - all static pages with hardcoded data
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Reports routes (using TicketController - keeping "reports" naming)
Route::middleware('auth')->group(function () {
    Route::get('/reports', [App\Http\Controllers\TicketController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [App\Http\Controllers\TicketController::class, 'create'])->name('reports.create');
    Route::post('/reports', [App\Http\Controllers\TicketController::class, 'store'])->name('reports.store');
    Route::get('/reports/{ticket}', [App\Http\Controllers\TicketController::class, 'show'])->name('reports.show');
    Route::patch('/reports/{ticket}', [App\Http\Controllers\TicketController::class, 'update'])->name('reports.update');
    Route::post('/reports/{ticket}/messages', [App\Http\Controllers\MessageController::class, 'store'])->name('reports.messages.store');
});

Route::get('/suggestions', [App\Http\Controllers\SuggestionController::class, 'index'])->name('suggestions.index');

Route::get('/suggestions/create', function () {
    return view('suggestions.create');
})->name('suggestions.create');

Route::post('/suggestions', [App\Http\Controllers\SuggestionController::class, 'store'])->name('suggestions.store');

Route::get('/suggestions/{id}', [App\Http\Controllers\SuggestionController::class, 'show'])->name('suggestions.show');
Route::post('/suggestions/{id}/comments', [App\Http\Controllers\SuggestionController::class, 'storeComment'])->name('suggestions.comments.store');

Route::get('/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements.index');

Route::get('/announcements/{id}', [App\Http\Controllers\AnnouncementController::class, 'show'])->name('announcements.show');

Route::post('/announcements', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('announcements.store');

Route::get('/faq', function () {
    return view('faq.index');
})->name('faq.index');

Route::get('/about', function () {
    return view('about.about');
})->name('about');

Route::get('/contact', function () {
    return view('about.contact');
})->name('contact');

Route::get('/privacy-policy', function () {
    return view('about.privacy-policy');
})->name('privacy-policy');

Route::get('/terms-of-service', function () {
    return view('about.terms-of-service');
})->name('terms-of-service');

Route::get('/profile', function () {
    return view('profile.index');
})->name('profile.index');

// Staff routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/staff/reports', [App\Http\Controllers\TicketController::class, 'index'])->name('staff.reports');
});

Route::get('/staff/suggestions', function () {
    return view('staff.suggestions');
})->name('staff.suggestions');

Route::get('/staff/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('staff.announcements');

// Auth routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Dashboard redirects to reports
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('reports.index');
    })->name('dashboard');
});
