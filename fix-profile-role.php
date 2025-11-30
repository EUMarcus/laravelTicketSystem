<?php

// Quick script to fix makoy@gmail.com profile role
// Run: php fix-profile-role.php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = \App\Models\User::where('email', 'makoy@gmail.com')->first();

if ($user) {
    $profile = \App\Models\Profile::find($user->id);
    if ($profile) {
        $profile->update(['role' => 'employee']);
        echo "✓ Profile updated! Role is now: " . $profile->role . "\n";
        echo "✓ User ID: " . $user->id . "\n";
        echo "✓ Email: " . $user->email . "\n";
    } else {
        echo "✗ Profile not found for user\n";
    }
} else {
    echo "✗ User not found\n";
}

