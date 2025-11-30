<?php

namespace Database\Seeders;

use App\Services\SupabaseService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supabase = app(SupabaseService::class);

        // Check if Supabase is configured
        if (!$supabase->isConfigured()) {
            $this->command->warn('Supabase is not configured. Skipping suggestion seeding.');
            $this->command->info('To seed suggestions, please set SUPABASE_URL and SUPABASE_SERVICE_KEY in your .env file.');
            return;
        }

        $suggestions = [
            [
                'title' => 'Weekly Community Exercise Program',
                'category' => 'Health',
                'full_content' => 'I suggest we organize a weekly community exercise program to promote health and wellness among residents. This could include activities like morning walks, yoga sessions, or group fitness classes. Regular exercise has been proven to improve physical and mental health, and doing it as a community would also strengthen our social bonds. We could hold these sessions in the barangay plaza or community center every Saturday morning from 6:00 AM to 7:30 AM. This initiative would benefit all age groups and help create a healthier, more active community.',
            ],
            [
                'title' => 'Install Solar-Powered Streetlights',
                'category' => 'Infrastructure',
                'full_content' => 'I recommend installing solar-powered streetlights in our community to improve safety and reduce energy costs. Solar streetlights are environmentally friendly, cost-effective in the long run, and would provide better lighting in areas that currently have poor visibility. This would enhance security, especially during nighttime, and help reduce accidents. We could start with the main streets and gradually expand to other areas. The initial investment would pay off through reduced electricity bills and improved community safety.',
            ],
            [
                'title' => 'Monthly Barangay Festival',
                'category' => 'Events',
                'full_content' => 'I propose organizing a monthly barangay festival to bring the community together and celebrate our local culture. Each month could have a different theme - food festival, talent show, sports competition, or cultural showcase. This would provide entertainment for residents, support local vendors and artists, and create opportunities for community bonding. The festival could be held on the last Saturday of each month at the barangay plaza. This would become a regular event that residents look forward to and help strengthen our community spirit.',
            ],
            [
                'title' => 'Community Garden Project',
                'category' => 'Service',
                'full_content' => 'I suggest creating a community garden where residents can grow vegetables and herbs together. This would promote sustainable living, provide fresh produce for families, and serve as an educational space for children. The garden could be located in an unused area of the barangay and managed by volunteers. We could organize workshops on organic farming and composting. This project would not only benefit the environment but also help reduce food costs for participating families and teach valuable skills to the younger generation.',
            ],
            [
                'title' => 'Free Wi-Fi in Public Areas',
                'category' => 'Infrastructure',
                'full_content' => 'I recommend installing free Wi-Fi hotspots in key public areas like the barangay hall, plaza, and community center. This would help students with their studies, enable residents to access important online services, and support local businesses. In today\'s digital age, internet access is essential for education, communication, and accessing government services. This initiative would bridge the digital divide and make our community more connected and accessible.',
            ],
            [
                'title' => 'Senior Citizens Day Program',
                'category' => 'Service',
                'full_content' => 'I propose establishing a monthly Senior Citizens Day program with activities, health check-ups, and social gatherings. This would provide our elderly residents with opportunities to stay active, socialize, and receive necessary health services. Activities could include light exercises, games, educational talks, and free medical consultations. This program would show our appreciation for our senior citizens and ensure they remain an active part of our community. We could hold this on the first Friday of every month.',
            ],
            [
                'title' => 'Youth Sports League',
                'category' => 'Education',
                'full_content' => 'I suggest organizing a youth sports league for basketball, volleyball, and other activities. This would keep our young people engaged in positive activities, promote physical fitness, and teach valuable lessons about teamwork and sportsmanship. We could organize tournaments between different zones in our barangay and provide basic equipment. This would help reduce youth idleness and provide a healthy outlet for their energy. The league could run throughout the year with different sports seasons.',
            ],
            [
                'title' => 'Recycling Center',
                'category' => 'Service',
                'full_content' => 'I recommend establishing a community recycling center where residents can bring recyclable materials. This would help reduce waste, protect the environment, and potentially generate income for community projects. The center could accept paper, plastic, metal, and electronic waste. We could partner with recycling companies and use the proceeds to fund other community initiatives. This would also educate residents about proper waste management and environmental responsibility.',
            ],
            [
                'title' => 'Community Library and Study Hall',
                'category' => 'Education',
                'full_content' => 'I propose creating a community library and study hall for students and residents. This would provide a quiet space for studying, access to books and educational resources, and internet access for research. Many students in our community may not have a conducive study environment at home. This facility would support their education and academic success. We could start with donated books and gradually expand the collection. The study hall could be open during weekdays and weekends.',
            ],
            [
                'title' => 'Emergency Response Team Training',
                'category' => 'Safety',
                'full_content' => 'I suggest organizing regular training sessions for a community emergency response team. This would prepare residents to respond effectively to natural disasters, medical emergencies, and other crises. Training could include first aid, fire safety, evacuation procedures, and basic rescue techniques. Having trained community members would significantly improve our preparedness and response capabilities during emergencies. This could save lives and minimize damage during disasters.',
            ],
            [
                'title' => 'Weekly Market Day',
                'category' => 'Service',
                'full_content' => 'I recommend establishing a weekly market day where local vendors can sell fresh produce, homemade goods, and local products. This would support local farmers and entrepreneurs, provide residents with access to fresh and affordable goods, and create a vibrant community gathering space. The market could be held every Sunday morning in the barangay plaza. This would boost the local economy and create a sense of community while supporting local businesses.',
            ],
            [
                'title' => 'Digital Skills Training Program',
                'category' => 'Education',
                'full_content' => 'I propose organizing free digital skills training programs for residents, especially for senior citizens and those who need to improve their computer literacy. This would help bridge the digital divide and enable more residents to access online services, communicate with family, and find employment opportunities. Training could cover basic computer use, internet navigation, email, social media, and online banking. This would empower residents and help them adapt to our increasingly digital world.',
            ],
        ];

        $this->command->info('Seeding suggestions...');

        foreach ($suggestions as $index => $suggestion) {
            try {
                $supabase->insert('suggestions', $suggestion);
                $this->command->info('✓ Created: ' . $suggestion['title']);
            } catch (\Exception $e) {
                $this->command->error('✗ Failed to create: ' . $suggestion['title']);
                $this->command->error('  Error: ' . $e->getMessage());
            }
        }

        $this->command->info('Suggestion seeding completed!');
    }
}

