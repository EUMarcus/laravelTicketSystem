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
    Route::get('/reports/{ticket}/edit', [App\Http\Controllers\TicketController::class, 'edit'])->name('reports.edit');
    Route::patch('/reports/{ticket}', [App\Http\Controllers\TicketController::class, 'update'])->name('reports.update');
    Route::delete('/reports/{ticket}', [App\Http\Controllers\TicketController::class, 'destroy'])->name('reports.destroy');
    Route::post('/reports/{ticket}/messages', [App\Http\Controllers\MessageController::class, 'store'])->name('reports.messages.store');
});

Route::get('/suggestions', [App\Http\Controllers\SuggestionController::class, 'index'])->name('suggestions.index');
Route::get('/suggestions/create', function () {
    return view('suggestions.create');
})->name('suggestions.create');
Route::post('/suggestions', [App\Http\Controllers\SuggestionController::class, 'store'])->name('suggestions.store');

// CRITICAL: More specific routes MUST come before less specific ones
// Define edit, comments, and status routes FIRST (before the catch-all {id} route)
// These routes have additional path segments, so they must be defined first
Route::get('/suggestions/{id}/edit', [App\Http\Controllers\SuggestionController::class, 'edit'])->name('suggestions.edit');
Route::post('/suggestions/{id}/comments', [App\Http\Controllers\SuggestionController::class, 'storeComment'])->name('suggestions.comments.store');
Route::middleware('auth')->patch('/suggestions/{id}/status', [App\Http\Controllers\SuggestionController::class, 'updateStatus'])->name('suggestions.status.update');

// Base {id} routes come LAST (these will match anything that doesn't match the routes above)
// IMPORTANT: These must be after /edit, /comments, and /status routes to avoid route conflicts
Route::get('/suggestions/{id}', [App\Http\Controllers\SuggestionController::class, 'show'])->name('suggestions.show');
Route::put('/suggestions/{id}', [App\Http\Controllers\SuggestionController::class, 'update'])->name('suggestions.update');
Route::delete('/suggestions/{id}', [App\Http\Controllers\SuggestionController::class, 'destroy'])->name('suggestions.destroy');

Route::get('/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements.index');

Route::middleware('auth')->group(function () {
    Route::post('/announcements', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('announcements.store');
    // More specific routes must come before less specific ones
    Route::get('/announcements/{id}/edit', [App\Http\Controllers\AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('/announcements/{id}', [App\Http\Controllers\AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('/announcements/{id}', [App\Http\Controllers\AnnouncementController::class, 'destroy'])->name('announcements.destroy');
});

Route::get('/announcements/{id}', [App\Http\Controllers\AnnouncementController::class, 'show'])->name('announcements.show');

Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq.index');

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Staff routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/staff/reports', [App\Http\Controllers\TicketController::class, 'index'])->name('staff.reports');
});

Route::get('/staff/suggestions', [App\Http\Controllers\SuggestionController::class, 'staffIndex'])->name('staff.suggestions');

Route::get('/staff/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('staff.announcements');

Route::middleware('auth')->group(function () {
    Route::get('/staff/faqs', [App\Http\Controllers\FaqController::class, 'staffIndex'])->name('staff.faqs');
    Route::get('/staff/faqs/create', [App\Http\Controllers\FaqController::class, 'create'])->name('staff.faqs.create');
    Route::post('/staff/faqs', [App\Http\Controllers\FaqController::class, 'store'])->name('staff.faqs.store');
    Route::get('/staff/faqs/{id}/edit', [App\Http\Controllers\FaqController::class, 'edit'])->name('staff.faqs.edit');
    Route::put('/staff/faqs/{id}', [App\Http\Controllers\FaqController::class, 'update'])->name('staff.faqs.update');
    Route::delete('/staff/faqs/{id}', [App\Http\Controllers\FaqController::class, 'destroy'])->name('staff.faqs.destroy');
});

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
    
    // Temporary debug route - remove after fixing
    Route::get('/debug-role', function () {
        $user = auth()->user();
        $profile = \App\Models\Profile::find($user->id);
        return response()->json([
            'user_id' => $user->id,
            'user_email' => $user->email,
            'profile_exists' => $profile ? 'YES' : 'NO',
            'profile_role' => $profile ? $profile->role : 'NO PROFILE',
            'session_role' => session('user')['role'] ?? 'NO SESSION',
            'is_employee' => $profile && in_array($profile->role, ['employee', 'admin']),
        ]);
    })->name('debug.role');
    
    // Quick fix route to update makoy@gmail.com profile role to employee
    Route::get('/fix-profile-role', function () {
        $user = \App\Models\User::where('email', 'makoy@gmail.com')->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        
        $profile = \App\Models\Profile::find($user->id);
        if (!$profile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }
        
        $oldRole = $profile->role;
        $profile->update(['role' => 'employee']);
        
        // Update session if user is logged in
        if (auth()->check() && auth()->user()->id === $user->id) {
            session(['user.role' => 'employee']);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Profile role updated',
            'old_role' => $oldRole,
            'new_role' => $profile->role,
            'user_email' => $user->email,
        ]);
    })->name('fix.profile.role');
});
