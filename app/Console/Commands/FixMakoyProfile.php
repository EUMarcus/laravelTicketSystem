<?php

namespace App\Console\Commands;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Console\Command;

class FixMakoyProfile extends Command
{
    protected $signature = 'fix:makoy-profile';
    protected $description = 'Fix makoy@gmail.com profile role to employee';

    public function handle()
    {
        $user = User::where('email', 'makoy@gmail.com')->first();
        
        if (!$user) {
            $this->error('User makoy@gmail.com not found!');
            return 1;
        }
        
        $profile = Profile::find($user->id);
        
        if (!$profile) {
            $this->error('Profile not found for user!');
            return 1;
        }
        
        $oldRole = $profile->role;
        $profile->update(['role' => 'employee']);
        
        $this->info("✓ Profile updated!");
        $this->info("  Old role: {$oldRole}");
        $this->info("  New role: {$profile->role}");
        $this->info("  User ID: {$user->id}");
        
        return 0;
    }
}

