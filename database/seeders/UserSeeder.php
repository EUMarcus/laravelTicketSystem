<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding users...');

        // Create your account as an employee
        $makoyUser = User::firstOrCreate(
            ['email' => 'makoy@gmail.com'],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Makoy',
                'password' => Hash::make('password'), // Default password, change it after first login
                'voters_id' => strtoupper(Str::random(22)),
                'contact_number' => '09123456789',
                'address' => 'Barangay Address',
            ]
        );

        // Use updateOrCreate to ensure role is always set to employee
        $makoyProfile = Profile::updateOrCreate(
            ['id' => $makoyUser->id],
            [
                'role' => 'employee',
                'name' => 'Makoy',
            ]
        );

        $this->command->info('✓ Created: makoy@gmail.com (Employee)');

        // Create a test citizen account
        $testUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'voters_id' => strtoupper(Str::random(22)),
                'contact_number' => '09111111111',
                'address' => 'Test Address',
            ]
        );

        Profile::firstOrCreate(
            ['id' => $testUser->id],
            [
                'role' => 'customer',
                'name' => 'Test User',
            ]
        );

        $this->command->info('✓ Created: test@example.com (Citizen)');

        $this->command->info('User seeding completed!');
        $this->command->info('');
        $this->command->warn('Default password for all accounts: password');
        $this->command->warn('Please change your password after first login!');
    }
}

