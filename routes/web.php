<?php

use Illuminate\Support\Facades\Route;

// Frontend-only routes - all static pages with hardcoded data
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/reports', function () {
    return view('reports.index');
})->name('reports.index');

Route::get('/reports/create', function () {
    return view('reports.create');
})->name('reports.create');

Route::get('/reports/my-reports', function () {
    return view('reports.my-reports');
})->name('reports.my-reports');

Route::get('/reports/my-reports/{id}', function ($id) {
    return view('reports.my-report-details', ['id' => $id]);
})->name('reports.my-report-details');

Route::get('/reports/{id}', function ($id) {
    return view('reports.show', ['id' => $id]);
})->name('reports.show');

Route::get('/suggestions', function () {
    return view('suggestions.index');
})->name('suggestions.index');

Route::get('/suggestions/create', function () {
    return view('suggestions.create');
})->name('suggestions.create');

Route::get('/suggestions/{id}', function ($id) {
    return view('suggestions.show', ['id' => $id]);
})->name('suggestions.show');

Route::get('/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements.index');

Route::get('/announcements/{id}', [App\Http\Controllers\AnnouncementController::class, 'show'])->name('announcements.show');

Route::post('/announcements', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('announcements.store');
    
Route::get('/events', function () {
    return view('events.index');
})->name('events.index');

Route::get('/events/{id}', function ($id) {
    return view('events.show', ['id' => $id]);
})->name('events.show');

Route::get('/polls', function () {
    return view('polls.index');
})->name('polls.index');

Route::get('/polls/{id}', function ($id) {
    return view('polls.show', ['id' => $id]);
})->name('polls.show');

Route::get('/faq', function () {
    return view('faq.index');
})->name('faq.index');

Route::get('/profile', function () {
    return view('profile.index');
})->name('profile.index');

// Staff routes
Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard');

Route::get('/staff/reports', function () {
    return view('staff.reports');
})->name('staff.reports');

Route::get('/staff/suggestions', function () {
    return view('staff.suggestions');
})->name('staff.suggestions');

Route::get('/staff/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('staff.announcements');

Route::get('/staff/events', function () {
    return view('staff.events');
})->name('staff.events');

Route::get('/staff/polls', function () {
    return view('staff.polls');
})->name('staff.polls');

// Auth routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
