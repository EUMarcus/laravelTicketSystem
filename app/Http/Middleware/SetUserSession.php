<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is authenticated but session('user') is not set, set it
        if (Auth::check() && !$request->session()->has('user')) {
            $user = Auth::user();
            $profile = \App\Models\Profile::find($user->id) ?? \App\Models\Profile::where('name', $user->name)->first();
            
            $request->session()->put('user', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $profile ? $profile->role : 'citizen',
                'voters_id' => $user->voters_id ?? null,
                'contact_number' => $user->contact_number ?? null,
                'address' => $user->address ?? null,
            ]);
        }
        
        // If user is not authenticated but session('user') exists, clear it
        if (!Auth::check() && $request->session()->has('user')) {
            $request->session()->forget('user');
        }

        return $next($request);
    }
}
