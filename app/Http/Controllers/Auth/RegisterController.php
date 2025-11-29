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
            'contact_number' => ['required', 'string', 'max:20'],
            'voters_id' => ['required', 'string', 'size:22', 'regex:/^[A-Za-z0-9]{22}$/', 'unique:users,voters_id'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:citizen,employee'],
        ]);

        $userId = (string) Str::uuid();
        
        $user = User::create([
            'id' => $userId,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'voters_id' => strtoupper($request->voters_id),
            'contact_number' => $request->contact_number,
            'address' => $request->address,
        ]);

        // Create profile with same UUID as user
        $profile = Profile::create([
            'id' => $userId,
            'role' => $request->role === 'citizen' ? 'customer' : 'employee',
            'name' => $request->name,
        ]);

        Auth::login($user);

        // Set session user data for views and JavaScript
        $request->session()->put('user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $profile->role,
            'voters_id' => $user->voters_id,
            'contact_number' => $user->contact_number,
            'address' => $user->address,
        ]);

        return redirect()->route('dashboard')->with('success', 'Account created successfully! Welcome to Community Hub.');
    }
}


