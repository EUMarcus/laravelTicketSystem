<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $profile = \App\Models\Profile::find($user->id);
            $role = $profile ? $profile->role : 'citizen';
            
            // Redirect staff to staff dashboard, citizens to reports
            if (in_array($role, ['employee', 'admin'])) {
                return redirect()->route('staff.dashboard');
            }
            return redirect()->route('reports.index');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Get fresh user instance after authentication
            $user = Auth::user();
            
            // Load profile directly from database using the user's ID
            $profile = \App\Models\Profile::where('id', $user->id)->first();
            
            // Get role - default to citizen if profile doesn't exist
            $role = $profile ? $profile->role : 'citizen';
            
            // DEBUG: Log what we found (check storage/logs/laravel.log after login)
            \Log::info('=== LOGIN DEBUG ===', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'profile_exists' => $profile ? 'YES' : 'NO',
                'profile_role' => $role,
                'is_employee' => in_array($role, ['employee', 'admin']) ? 'YES' : 'NO',
            ]);
            
            // Set session user data for views and JavaScript
            $request->session()->put('user', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role,
                'voters_id' => $user->voters_id ?? null,
                'contact_number' => $user->contact_number ?? null,
                'address' => $user->address ?? null,
            ]);
            
            // Check if user is an employee (staff/admin)
            // Check role directly - employee or admin should go to staff dashboard
            $isEmployee = in_array($role, ['employee', 'admin']);
            
            // Clear any intended URL to prevent conflicts
            $request->session()->forget('url.intended');
            
            // Force save session before redirect
            $request->session()->save();
            
            // TEMPORARY: Add dd() to debug - remove after fixing
            // Uncomment the line below to see what's happening:
            // dd(['role' => $role, 'isEmployee' => $isEmployee, 'profile' => $profile]);
            
            if ($isEmployee) {
                // Employee - redirect to staff dashboard
                \Log::info('>>> REDIRECTING TO STAFF DASHBOARD <<<', ['user_id' => $user->id, 'role' => $role]);
                return redirect()->route('staff.dashboard')->with('success', 'Welcome back, Staff!');
            } else {
                // Citizen - redirect to reports index
                \Log::info('>>> REDIRECTING TO REPORTS <<<', ['user_id' => $user->id, 'role' => $role]);
                return redirect()->route('reports.index');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Clear session user data
        $request->session()->forget('user');
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Return a response that will trigger localStorage clearing via JavaScript
        return redirect('/')->with('logout', true);
    }
}


