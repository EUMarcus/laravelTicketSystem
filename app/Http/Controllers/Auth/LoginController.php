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
            
            $user = Auth::user();
            $profile = \App\Models\Profile::where('id', $user->id)->first();
            $role = $profile ? $profile->role : 'citizen';
            
            $request->session()->put('user', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role,
                'voters_id' => $user->voters_id ?? null,
                'contact_number' => $user->contact_number ?? null,
                'address' => $user->address ?? null,
            ]);
            
            $isEmployee = in_array($role, ['employee', 'admin']);
            $request->session()->forget('url.intended');
            $request->session()->save();
            
            if ($isEmployee) {
                return redirect()->route('staff.dashboard')->with('success', 'Welcome back, Staff!');
            } else {
                return redirect()->route('reports.index');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('logout', true);
    }
}


