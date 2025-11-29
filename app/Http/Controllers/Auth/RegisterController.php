<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'contact' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        $userId = (string) Str::uuid();
        
        $user = User::create([
            'id' => $userId,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Create profile with same UUID as user (default to customer role)
        Profile::create([
            'id' => $userId,
            'role' => 'customer', // Default role - can be changed by admin later
            'name' => $validated['name'],
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Account created successfully! Welcome to Community Hub.');
    }
}


