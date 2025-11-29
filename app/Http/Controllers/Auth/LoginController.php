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

        // Frontend-only authentication (hardcoded users for development)
        $validUsers = [
            'jon@gmail.com' => [
                'password' => '123456789',
                'role' => 'citizen',
                'name' => 'Jon',
                'id' => 'temp_jon_123'
            ],
            'makoy@gmail.com' => [
                'password' => '123456789',
                'role' => 'employee',
                'name' => 'Makoy',
                'id' => 'temp_makoy_123'
            ]
        ];

        $email = $credentials['email'];
        $password = $credentials['password'];

        // Check if user exists and password matches
        if (isset($validUsers[$email]) && $validUsers[$email]['password'] === $password) {
            $user = $validUsers[$email];
            
            // Store user data in session
            $request->session()->put('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $email,
                'role' => $user['role']
            ]);

            // Redirect based on role
            if ($user['role'] === 'employee') {
                // Employee - redirect to reports page (or employee dashboard)
                return redirect()->route('reports.index')->with('success', 'Welcome back, Staff!');
            } else {
                // Citizen - redirect to reports/create page (reporting page)
                return redirect()->route('reports.create')->with('success', 'Welcome back!');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Frontend-only logout
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Return a response that will trigger localStorage clearing via JavaScript
        return redirect('/')->with('logout', true);
    }
}


