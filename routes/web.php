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

Route::get('/announcements', function () {
    return view('announcements.index');
})->name('announcements.index');

Route::get('/announcements/{id}', function ($id) {
    return view('announcements.show', ['id' => $id]);
})->name('announcements.show');
    
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

// Auth routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
