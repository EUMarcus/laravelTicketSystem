<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $profile = $user->profile;
        
        if (!$profile) {
            $profile = Profile::create([
                'id' => $user->id,
                'role' => 'citizen',
                'name' => $user->name,
            ]);
        }

        $ticketsCount = $user->profile->tickets()->count();
        $suggestionsCount = \App\Models\Suggestion::where('posted_by', $user->id)->count();

        return view('profile.index', compact('user', 'profile', 'ticketsCount', 'suggestionsCount'));
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = Profile::create([
                'id' => $user->id,
                'role' => 'citizen',
                'name' => $user->name,
            ]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'voters_id' => ['nullable', 'string', 'size:22', 'regex:/^[A-Za-z0-9]{22}$/', 'unique:users,voters_id,' . $user->id],
            'contact_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            DB::beginTransaction();

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'voters_id' => !empty($validated['voters_id']) ? strtoupper($validated['voters_id']) : $user->voters_id,
                'contact_number' => $validated['contact_number'] ?? $user->contact_number,
                'address' => $validated['address'] ?? $user->address,
            ]);

            if (!empty($validated['password'])) {
                $user->update([
                    'password' => Hash::make($validated['password']),
                ]);
            }

            $profile->update([
                'name' => $validated['name'],
            ]);

            $request->session()->put('user', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $profile->role,
                'voters_id' => $user->voters_id,
                'contact_number' => $user->contact_number,
                'address' => $user->address,
            ]);

            DB::commit();

            return redirect()->route('profile.index')
                ->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to update profile: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Failed to update profile. Please try again.']);
        }
    }

    public function destroy(Request $request)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $user = Auth::user();

        try {
            DB::beginTransaction();

            $profile = $user->profile;
            if ($profile) {
                $profile->tickets()->delete();
                $profile->assignedTickets()->update(['assigned_employee_id' => null]);
                $profile->messages()->delete();
                $profile->delete();
            }

            $user->delete();

            DB::commit();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home')
                ->with('success', 'Your account has been deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to delete account: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['message' => 'Failed to delete account. Please try again.']);
        }
    }
}
