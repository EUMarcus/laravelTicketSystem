<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users first (including your account)
        $this->call([
            UserSeeder::class,
        ]);

        // Seed announcements, suggestions, and tickets
        $this->call([
            AnnouncementSeeder::class,
            SuggestionSeeder::class,
            TicketSeeder::class,
        ]);
    }
}
