@extends('layouts.app')

@section('title', 'FAQ - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h1>
            <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Find answers to common questions about our community services</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-10">
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="text-3xl font-bold text-gray-900 mb-1">24</div>
                <div class="text-sm font-medium text-gray-600">Total Questions</div>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="text-3xl font-bold text-[#65B741] mb-1">6</div>
                <div class="text-sm font-medium text-gray-600">Categories</div>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="text-3xl font-bold text-[#FFB534] mb-1">18</div>
                <div class="text-sm font-medium text-gray-600">Most Viewed</div>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="text-3xl font-bold text-gray-700 mb-1">Updated</div>
                <div class="text-sm font-medium text-gray-600">This Month</div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <input type="text" id="faqSearch" placeholder="Search questions..." class="w-full px-4 py-2 pl-10 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none" style="background-color: white !important; color: #111827 !important;">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <div class="flex items-center gap-3 flex-wrap">
                <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Filter:</span>
                <button onclick="filterByCategory('all')" class="category-filter px-4 py-2 rounded-lg text-sm font-semibold transition-colors bg-gray-900 text-white" data-category="all">
                    All
                </button>
                <button onclick="filterByCategory('Reporting & Tickets')" class="category-filter px-4 py-2 rounded-lg text-sm font-semibold transition-colors bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400" data-category="Reporting & Tickets">
                    Reports
                </button>
                <button onclick="filterByCategory('Barangay Documents')" class="category-filter px-4 py-2 rounded-lg text-sm font-semibold transition-colors bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400" data-category="Barangay Documents">
                    Documents
                </button>
                <button onclick="filterByCategory('Events & Programs')" class="category-filter px-4 py-2 rounded-lg text-sm font-semibold transition-colors bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400" data-category="Events & Programs">
                    Events
                </button>
                <button onclick="filterByCategory('Contact')" class="category-filter px-4 py-2 rounded-lg text-sm font-semibold transition-colors bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400" data-category="Contact">
                    Contact
                </button>
            </div>
        </div>
    </div>

    <!-- FAQ Accordion -->
    @php
        $faqs = [
            ['category' => 'Reporting & Tickets', 'question' => 'How do I submit a report?', 'answer' => 'Click on "Reports" in the navigation menu, then click "New Report". Fill out the form with the issue details, location, and optional photos. Submit your report and track its progress. You can view the status of your reports anytime in your profile.'],
            ['category' => 'Reporting & Tickets', 'question' => 'Can I submit a report anonymously?', 'answer' => 'Yes, you can choose to submit reports anonymously by checking the "Submit as Anonymous" option when creating a report. Anonymous reports are still processed, but your identity will not be disclosed.'],
            ['category' => 'Reporting & Tickets', 'question' => 'How long does it take to resolve a report?', 'answer' => 'Response time varies depending on the urgency and type of issue. High priority reports are typically addressed within 24-48 hours, while normal priority reports may take 3-5 business days. You can track the status of your report in real-time.'],
            ['category' => 'Reporting & Tickets', 'question' => 'What types of issues can I report?', 'answer' => 'You can report various community issues including: road problems (potholes, cracks), flooding and drainage issues, broken streetlights, garbage and cleanliness concerns, noise complaints, safety and security issues, stray animals, and other community concerns.'],
            ['category' => 'Barangay Documents', 'question' => 'How do I request barangay documents?', 'answer' => 'Visit the barangay hall during office hours (Monday-Friday, 8:00 AM - 5:00 PM) and bring a valid ID. For specific documents, you may need to fill out a request form. Some documents can also be requested online through our portal.'],
            ['category' => 'Barangay Documents', 'question' => 'What documents can I get from the barangay?', 'answer' => 'Common documents include Barangay Clearance, Certificate of Residency, Certificate of Indigency, Certificate of Good Moral Character, Business Permit, and other certifications as needed. Each document has specific requirements.'],
            ['category' => 'Barangay Documents', 'question' => 'How long does it take to process documents?', 'answer' => 'Most barangay documents can be processed on the same day if all requirements are met. Some documents may require 1-2 business days for verification. Complex requests may take up to 5 business days.'],
            ['category' => 'Barangay Documents', 'question' => 'What are the requirements for barangay clearance?', 'answer' => 'To obtain a Barangay Clearance, you need: Valid government-issued ID, Proof of residency (utility bill, rental agreement, etc.), Completed application form, and payment of processing fee. The clearance is typically issued on the same day.'],
            ['category' => 'Events & Programs', 'question' => 'How do I register for community events?', 'answer' => 'Check the Events page for upcoming activities. Some events may require registration through the barangay office or online forms. Details are provided in each event listing including registration deadlines and requirements.'],
            ['category' => 'Events & Programs', 'question' => 'Are events free for residents?', 'answer' => 'Most community events are free for residents. Some special programs or workshops may have fees, which will be clearly indicated in the event details. Free events are marked accordingly on the Events page.'],
            ['category' => 'Events & Programs', 'question' => 'Can I suggest an event or program?', 'answer' => 'Yes! You can submit event suggestions through the Suggestions page. Community members can vote on suggestions, and popular ideas are considered for implementation. Your input helps shape our community activities.'],
            ['category' => 'Events & Programs', 'question' => 'What types of events are organized?', 'answer' => 'We organize various events including: community clean-up days, health check-ups, festivals and celebrations, workshops and seminars, sports tournaments, cultural activities, and educational programs. Check the Events page for current listings.'],
            ['category' => 'Suggestions & Polls', 'question' => 'How do I submit a suggestion?', 'answer' => 'Click on "Suggestions" in the navigation menu, then click "New Suggestion". Fill out the form with your idea, category, and description. You can submit anonymously if preferred. Other community members can vote and comment on your suggestion.'],
            ['category' => 'Suggestions & Polls', 'question' => 'Do I need to login to vote on suggestions or polls?', 'answer' => 'No login required! You can vote on suggestions and participate in polls without creating an account. The system uses your browser to track your participation and prevent duplicate votes.'],
            ['category' => 'Suggestions & Polls', 'question' => 'How are polls used in the community?', 'answer' => 'Polls help us make community decisions based on resident preferences. Topics include event planning, service improvements, facility priorities, and program preferences. Results are used to guide barangay initiatives and resource allocation.'],
            ['category' => 'Contact', 'question' => 'How can I contact the barangay office?', 'answer' => 'You can contact us at (02) 123-4567, email us at info@communityhub.ph, or visit the barangay hall at [Address] during office hours (Monday-Friday, 8:00 AM - 5:00 PM). For emergencies, call our 24/7 hotline.'],
            ['category' => 'Contact', 'question' => 'What are the barangay office hours?', 'answer' => 'Regular office hours are Monday to Friday, 8:00 AM to 5:00 PM. We are closed on weekends and holidays. Some services may be available by appointment outside regular hours. Emergency services are available 24/7.'],
            ['category' => 'Contact', 'question' => 'Where is the barangay hall located?', 'answer' => 'The barangay hall is located at [Address]. It is easily accessible by public transportation and has parking available. You can also find us on the map link provided in the contact section.'],
            ['category' => 'General', 'question' => 'How do I stay updated with community news?', 'answer' => 'Check the Announcements page regularly for important updates. You can also follow us on social media, subscribe to our newsletter, or visit the barangay hall for printed announcements. Important notices are posted on community bulletin boards.'],
            ['category' => 'General', 'question' => 'How can I get involved in community activities?', 'answer' => 'There are many ways to get involved! You can volunteer for events, join community programs, participate in meetings, submit suggestions, vote on polls, and attend community gatherings. Check the Events and Suggestions pages for opportunities.'],
            ['category' => 'General', 'question' => 'Is this website secure?', 'answer' => 'Yes, we take security seriously. Your personal information is protected, and we use secure methods for data transmission. Anonymous submissions are available for sensitive reports. We comply with data privacy regulations.'],
            ['category' => 'General', 'question' => 'Can I access this website on mobile?', 'answer' => 'Yes! Our website is fully responsive and works on all devices including smartphones and tablets. You can access all features, submit reports, vote on polls, and view announcements from any device with internet connection.'],
        ];
    @endphp

    <div id="faqContainer" class="space-y-4">
        @foreach($faqs as $index => $faq)
            <div class="faq-item bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden" data-category="{{ $faq['category'] }}">
                <button onclick="toggleFaq({{ $index }})" class="w-full p-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors" id="faq-button-{{ $index }}">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                {{ $faq['category'] }}
                            </span>
                        </div>
                        <h3 class="text-base font-bold text-gray-900">{{ $faq['question'] }}</h3>
                    </div>
                    <svg class="w-5 h-5 text-gray-500 flex-shrink-0 ml-4 faq-icon" id="faq-icon-{{ $index }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden px-5 pb-5" id="faq-answer-{{ $index }}">
                    <div class="pt-2 border-t border-gray-100">
                        <p class="text-gray-700 leading-relaxed">{{ $faq['answer'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- No Results Message -->
    <div id="noResults" class="hidden text-center py-12">
        <p class="text-gray-500 text-lg">No questions found matching your search.</p>
    </div>
</div>

<script>
function toggleFaq(index) {
    const answer = document.getElementById(`faq-answer-${index}`);
    const icon = document.getElementById(`faq-icon-${index}`);
    const button = document.getElementById(`faq-button-${index}`);
    
    if (answer.classList.contains('hidden')) {
        // Close all other FAQs
        document.querySelectorAll('.faq-answer').forEach(item => {
            if (!item.classList.contains('hidden') && item.id !== `faq-answer-${index}`) {
                item.classList.add('hidden');
                const otherIndex = item.id.split('-')[2];
                document.getElementById(`faq-icon-${otherIndex}`).classList.remove('rotate-180');
                document.getElementById(`faq-button-${otherIndex}`).classList.remove('bg-gray-50');
            }
        });
        
        // Open this FAQ
        answer.classList.remove('hidden');
        icon.classList.add('rotate-180');
        button.classList.add('bg-gray-50');
    } else {
        // Close this FAQ
        answer.classList.add('hidden');
        icon.classList.remove('rotate-180');
        button.classList.remove('bg-gray-50');
    }
}

function filterByCategory(category) {
    const faqItems = document.querySelectorAll('.faq-item');
    const categoryFilters = document.querySelectorAll('.category-filter');
    let visibleCount = 0;
    
    // Update filter button styles
    categoryFilters.forEach(btn => {
        if (btn.dataset.category === category) {
            btn.classList.remove('bg-white', 'border', 'border-gray-300', 'text-gray-700');
            btn.classList.add('bg-gray-900', 'text-white');
        } else {
            btn.classList.remove('bg-gray-900', 'text-white');
            btn.classList.add('bg-white', 'border', 'border-gray-300', 'text-gray-700');
        }
    });
    
    // Filter FAQs
    faqItems.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    const noResults = document.getElementById('noResults');
    if (visibleCount === 0) {
        noResults.classList.remove('hidden');
    } else {
        noResults.classList.add('hidden');
    }
}

// Search functionality
document.getElementById('faqSearch').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item');
    let visibleCount = 0;
    
    faqItems.forEach(item => {
        const question = item.querySelector('h3').textContent.toLowerCase();
        const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
        const category = item.dataset.category.toLowerCase();
        
        if (question.includes(searchTerm) || answer.includes(searchTerm) || category.includes(searchTerm)) {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    const noResults = document.getElementById('noResults');
    if (visibleCount === 0 && searchTerm !== '') {
        noResults.classList.remove('hidden');
    } else {
        noResults.classList.add('hidden');
    }
});
</script>

<style>
.faq-icon {
    transition: transform 0.3s ease;
}
.faq-icon.rotate-180 {
    transform: rotate(180deg);
}
</style>
@endsection
