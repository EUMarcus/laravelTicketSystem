<?php

namespace Database\Seeders;

use App\Services\SupabaseService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supabase = app(SupabaseService::class);

        // Check if Supabase is configured
        if (!$supabase->isConfigured()) {
            $this->command->warn('Supabase is not configured. Skipping announcement seeding.');
            $this->command->info('To seed announcements, please set SUPABASE_URL and SUPABASE_SERVICE_KEY in your .env file.');
            return;
        }

        $announcements = [
            [
                'title' => 'Community Clean-Up Day Scheduled',
                'category' => 'Event',
                'full_content' => 'We are excited to announce our upcoming Community Clean-Up Day scheduled for Saturday, December 14, 2024, from 8:00 AM to 12:00 PM. This is a community-wide initiative to clean and beautify our barangay. All residents are warmly invited to participate in this activity. Together, we can make our community a cleaner and more beautiful place to live. Please bring your own cleaning materials and gloves. Refreshments will be provided.',
                'urgent' => false,
                'start_date' => Carbon::now()->addDays(7)->setTime(8, 0)->toIso8601String(),
                'end_date' => Carbon::now()->addDays(7)->setTime(12, 0)->toIso8601String(),
            ],
            [
                'title' => 'Health Advisory: Dengue Prevention',
                'category' => 'Health',
                'full_content' => 'Important reminders on preventing dengue fever in our community. With the rainy season approaching, we urge all residents to take necessary precautions. Keep your surroundings clean and eliminate stagnant water where mosquitoes breed. Regularly check and clean water containers, flower pots, and drainage systems. If you experience symptoms such as high fever, severe headache, joint and muscle pain, please seek immediate medical attention. Let us work together to keep our community safe and healthy.',
                'urgent' => true,
                'start_date' => null,
                'end_date' => null,
            ],
            [
                'title' => 'Barangay Meeting This Saturday',
                'category' => 'Meeting',
                'full_content' => 'Monthly barangay meeting scheduled for this coming Saturday at 2:00 PM in the Barangay Hall. All residents are encouraged to attend and voice their concerns. Agenda items include: community projects update, budget allocation, and upcoming events. Your participation is important for the progress of our community. Light refreshments will be served after the meeting.',
                'urgent' => false,
                'start_date' => Carbon::now()->addDays(3)->setTime(14, 0)->toIso8601String(),
                'end_date' => Carbon::now()->addDays(3)->setTime(16, 0)->toIso8601String(),
            ],
            [
                'title' => 'New Water System Installation',
                'category' => 'Infrastructure',
                'full_content' => 'We are pleased to inform you that the new water system installation project will begin next week. This project aims to improve water supply and quality for all residents. The installation will be done in phases, and we will notify affected areas in advance. We appreciate your patience and cooperation during this important infrastructure improvement. For any concerns, please contact the barangay office.',
                'urgent' => false,
                'start_date' => Carbon::now()->addDays(5)->setTime(8, 0)->toIso8601String(),
                'end_date' => null,
            ],
            [
                'title' => 'Free Medical Check-Up Program',
                'category' => 'Health',
                'full_content' => 'Free medical check-up program for all residents will be held on December 20, 2024, from 8:00 AM to 4:00 PM at the Barangay Health Center. Services include: blood pressure monitoring, blood sugar testing, general consultation, and health education. This program is open to all residents, especially senior citizens. Please bring a valid ID and arrive early to avoid long queues. Registration starts at 7:30 AM.',
                'urgent' => false,
                'start_date' => Carbon::now()->addDays(15)->setTime(8, 0)->toIso8601String(),
                'end_date' => Carbon::now()->addDays(15)->setTime(16, 0)->toIso8601String(),
            ],
            [
                'title' => 'Road Repair Notice',
                'category' => 'Infrastructure',
                'full_content' => 'Please be advised that road repair work will be conducted on Main Street from December 10-15, 2024. The road will be partially closed during construction hours (7:00 AM to 5:00 PM). We recommend using alternative routes during this period. We apologize for any inconvenience this may cause and appreciate your understanding as we work to improve our infrastructure.',
                'urgent' => false,
                'start_date' => Carbon::now()->addDays(3)->setTime(7, 0)->toIso8601String(),
                'end_date' => Carbon::now()->addDays(8)->setTime(17, 0)->toIso8601String(),
            ],
            [
                'title' => 'Community Christmas Party',
                'category' => 'Event',
                'full_content' => 'Join us for our annual Community Christmas Party on December 23, 2024, starting at 6:00 PM at the Barangay Plaza. There will be food, games, performances, and a gift-giving activity for children. All residents are welcome! Please bring a dish to share for our potluck dinner. Let us celebrate the holiday season together as one community. For more information, contact the barangay office.',
                'urgent' => false,
                'start_date' => Carbon::now()->addDays(18)->setTime(18, 0)->toIso8601String(),
                'end_date' => Carbon::now()->addDays(18)->setTime(22, 0)->toIso8601String(),
            ],
            [
                'title' => 'Safety Reminder: Fire Prevention',
                'category' => 'Safety',
                'full_content' => 'As we approach the holiday season, we remind all residents to practice fire safety. Please check your electrical connections, avoid overloading outlets, and never leave cooking unattended. Keep flammable materials away from heat sources. In case of emergency, call the fire department immediately. Let us keep our community safe this holiday season.',
                'urgent' => true,
                'start_date' => null,
                'end_date' => null,
            ],
            [
                'title' => 'Scholarship Program Application',
                'category' => 'Education',
                'full_content' => 'Applications for the Barangay Scholarship Program are now open for the academic year 2025-2026. This program is open to high school graduates who are residents of our barangay. Requirements include: barangay clearance, proof of residency, high school diploma, and family income certificate. Application deadline is January 15, 2025. For more details, visit the barangay office or contact the education committee.',
                'urgent' => false,
                'start_date' => Carbon::now()->setTime(8, 0)->toIso8601String(),
                'end_date' => Carbon::now()->addDays(30)->setTime(17, 0)->toIso8601String(),
            ],
            [
                'title' => 'Waste Segregation Campaign',
                'category' => 'Service',
                'full_content' => 'Starting next month, we will implement a stricter waste segregation policy. All households are required to separate biodegradable, non-biodegradable, and recyclable waste. Collection schedules: Biodegradable - Monday and Thursday, Non-biodegradable - Tuesday and Friday, Recyclables - Wednesday. This initiative helps protect our environment and supports our recycling program. Educational materials will be distributed to all households.',
                'urgent' => false,
                'start_date' => Carbon::now()->addDays(7)->setTime(0, 0)->toIso8601String(),
                'end_date' => null,
            ],
        ];

        $this->command->info('Seeding announcements...');

        foreach ($announcements as $index => $announcement) {
            try {
                $supabase->insert('announcements', $announcement);
                $this->command->info('✓ Created: ' . $announcement['title']);
            } catch (\Exception $e) {
                $this->command->error('✗ Failed to create: ' . $announcement['title']);
                $this->command->error('  Error: ' . $e->getMessage());
            }
        }

        $this->command->info('Announcement seeding completed!');
    }
}

