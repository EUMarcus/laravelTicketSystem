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
            return redirect()->route('dashboard');
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
            
            // Redirect based on role
            $user = Auth::user();
            // With FK constraint, profile must exist for every user
            $profile = $user->profile;
            
            // Set session user data for views and JavaScript
            $request->session()->put('user', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $profile->role ?? 'citizen',
                'voters_id' => $user->voters_id ?? null,
                'contact_number' => $user->contact_number ?? null,
                'address' => $user->address ?? null,
            ]);
            
            if ($profile && $profile->isEmployee()) {
                // Employee - redirect to staff dashboard
                return redirect()->route('staff.dashboard')->with('success', 'Welcome back, Staff!');
            } else {
                // Citizen - redirect to reports index
                return redirect()->intended(route('reports.index'));
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


