<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
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
            
            // Automatically determine if user is staff (employee) or normal user (citizen) based on role
            $user = Auth::user();
            $profile = $user->profile;
            
            if ($profile && $profile->role === 'employee') {
                // Staff/Employee - redirect to home
                return redirect()->intended(route('home'))->with('success', 'Welcome back, Staff!');
            } else {
                // Normal user/Citizen - redirect to home
                return redirect()->intended(route('home'))->with('success', 'Welcome back!');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}


