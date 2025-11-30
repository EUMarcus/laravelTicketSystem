<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['category' => 'Reporting & Tickets', 'question' => 'How do I submit a report?', 'answer' => 'Click on "Reports" in the navigation menu, then click "New Report". Fill out the form with the issue details, location, and optional photos. Submit your report and track its progress. You can view the status of your reports anytime in your profile.', 'order' => 0],
            ['category' => 'Reporting & Tickets', 'question' => 'Can I submit a report anonymously?', 'answer' => 'Yes, you can choose to submit reports anonymously by checking the "Submit as Anonymous" option when creating a report. Anonymous reports are still processed, but your identity will not be disclosed.', 'order' => 1],
            ['category' => 'Reporting & Tickets', 'question' => 'How long does it take to resolve a report?', 'answer' => 'Response time varies depending on the urgency and type of issue. High priority reports are typically addressed within 24-48 hours, while normal priority reports may take 3-5 business days. You can track the status of your report in real-time.', 'order' => 2],
            ['category' => 'Reporting & Tickets', 'question' => 'What types of issues can I report?', 'answer' => 'You can report various community issues including: road problems (potholes, cracks), flooding and drainage issues, broken streetlights, garbage and cleanliness concerns, noise complaints, safety and security issues, stray animals, and other community concerns.', 'order' => 3],
            ['category' => 'Barangay Documents', 'question' => 'How do I request barangay documents?', 'answer' => 'Visit the barangay hall during office hours (Monday-Friday, 8:00 AM - 5:00 PM) and bring a valid ID. For specific documents, you may need to fill out a request form. Some documents can also be requested online through our portal.', 'order' => 0],
            ['category' => 'Barangay Documents', 'question' => 'What documents can I get from the barangay?', 'answer' => 'Common documents include Barangay Clearance, Certificate of Residency, Certificate of Indigency, Certificate of Good Moral Character, Business Permit, and other certifications as needed. Each document has specific requirements.', 'order' => 1],
            ['category' => 'Barangay Documents', 'question' => 'How long does it take to process documents?', 'answer' => 'Most barangay documents can be processed on the same day if all requirements are met. Some documents may require 1-2 business days for verification. Complex requests may take up to 5 business days.', 'order' => 2],
            ['category' => 'Barangay Documents', 'question' => 'What are the requirements for barangay clearance?', 'answer' => 'To obtain a Barangay Clearance, you need: Valid government-issued ID, Proof of residency (utility bill, rental agreement, etc.), Completed application form, and payment of processing fee. The clearance is typically issued on the same day.', 'order' => 3],
            ['category' => 'Events & Programs', 'question' => 'How do I register for community events?', 'answer' => 'Check the Events page for upcoming activities. Some events may require registration through the barangay office or online forms. Details are provided in each event listing including registration deadlines and requirements.', 'order' => 0],
            ['category' => 'Events & Programs', 'question' => 'Are events free for residents?', 'answer' => 'Most community events are free for residents. Some special programs or workshops may have fees, which will be clearly indicated in the event details. Free events are marked accordingly on the Events page.', 'order' => 1],
            ['category' => 'Events & Programs', 'question' => 'Can I suggest an event or program?', 'answer' => 'Yes! You can submit event suggestions through the Suggestions page. Community members can vote on suggestions, and popular ideas are considered for implementation. Your input helps shape our community activities.', 'order' => 2],
            ['category' => 'Events & Programs', 'question' => 'What types of events are organized?', 'answer' => 'We organize various events including: community clean-up days, health check-ups, festivals and celebrations, workshops and seminars, sports tournaments, cultural activities, and educational programs. Check the Events page for current listings.', 'order' => 3],
            ['category' => 'Suggestions & Polls', 'question' => 'How do I submit a suggestion?', 'answer' => 'Click on "Suggestions" in the navigation menu, then click "New Suggestion". Fill out the form with your idea, category, and description. You can submit anonymously if preferred. Other community members can vote and comment on your suggestion.', 'order' => 0],
            ['category' => 'Suggestions & Polls', 'question' => 'Do I need to login to vote on suggestions or polls?', 'answer' => 'No login required! You can vote on suggestions and participate in polls without creating an account. The system uses your browser to track your participation and prevent duplicate votes.', 'order' => 1],
            ['category' => 'Suggestions & Polls', 'question' => 'How are polls used in the community?', 'answer' => 'Polls help us make community decisions based on resident preferences. Topics include event planning, service improvements, facility priorities, and program preferences. Results are used to guide barangay initiatives and resource allocation.', 'order' => 2],
            ['category' => 'Contact', 'question' => 'How can I contact the barangay office?', 'answer' => 'You can contact us at (02) 123-4567, email us at info@communityhub.ph, or visit the barangay hall at [Address] during office hours (Monday-Friday, 8:00 AM - 5:00 PM). For emergencies, call our 24/7 hotline.', 'order' => 0],
            ['category' => 'Contact', 'question' => 'What are the barangay office hours?', 'answer' => 'Regular office hours are Monday to Friday, 8:00 AM to 5:00 PM. We are closed on weekends and holidays. Some services may be available by appointment outside regular hours. Emergency services are available 24/7.', 'order' => 1],
            ['category' => 'Contact', 'question' => 'Where is the barangay hall located?', 'answer' => 'The barangay hall is located at [Address]. It is easily accessible by public transportation and has parking available. You can also find us on the map link provided in the contact section.', 'order' => 2],
            ['category' => 'General', 'question' => 'How do I stay updated with community news?', 'answer' => 'Check the Announcements page regularly for important updates. You can also follow us on social media, subscribe to our newsletter, or visit the barangay hall for printed announcements. Important notices are posted on community bulletin boards.', 'order' => 0],
            ['category' => 'General', 'question' => 'How can I get involved in community activities?', 'answer' => 'There are many ways to get involved! You can volunteer for events, join community programs, participate in meetings, submit suggestions, vote on polls, and attend community gatherings. Check the Events and Suggestions pages for opportunities.', 'order' => 1],
            ['category' => 'General', 'question' => 'Is this website secure?', 'answer' => 'Yes, we take security seriously. Your personal information is protected, and we use secure methods for data transmission. Anonymous submissions are available for sensitive reports. We comply with data privacy regulations.', 'order' => 2],
            ['category' => 'General', 'question' => 'Can I access this website on mobile?', 'answer' => 'Yes! Our website is fully responsive and works on all devices including smartphones and tablets. You can access all features, submit reports, vote on polls, and view announcements from any device with internet connection.', 'order' => 3],
        ];

        foreach ($faqs as $faq) {
            Faq::create([
                'id' => (string) Str::uuid(),
                'category' => $faq['category'],
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'order' => $faq['order'],
            ]);
        }
    }
}
