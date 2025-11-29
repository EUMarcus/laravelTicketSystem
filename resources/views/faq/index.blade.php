@extends('layouts.app')

@section('title', 'FAQ - Community Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8 text-center" data-aos="fade-down">
        <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">Frequently Asked Questions</h1>
        <p class="text-text-secondary">Find answers to common questions about our community services</p>
    </div>

    <div class="space-y-4">
        @php
            $faqs = [
                ['category' => 'Reporting & Tickets', 'question' => 'How do I submit a report?', 'answer' => 'Click on "Reports" in the navigation menu, then click "New Report". Fill out the form with the issue details, location, and optional photos. Submit your report and track its progress.'],
                ['category' => 'Reporting & Tickets', 'question' => 'Can I submit a report anonymously?', 'answer' => 'Yes, you can choose to submit reports anonymously by checking the "Submit as Anonymous" option when creating a report.'],
                ['category' => 'Barangay Documents', 'question' => 'How do I request barangay documents?', 'answer' => 'Visit the barangay hall during office hours (Monday-Friday, 8:00 AM - 5:00 PM) and bring a valid ID. For specific documents, you may need to fill out a request form.'],
                ['category' => 'Barangay Documents', 'question' => 'What documents can I get from the barangay?', 'answer' => 'Common documents include Barangay Clearance, Certificate of Residency, Certificate of Indigency, and other certifications as needed.'],
                ['category' => 'Events & Programs', 'question' => 'How do I register for community events?', 'answer' => 'Check the Events page for upcoming activities. Some events may require registration through the barangay office or online forms. Details are provided in each event listing.'],
                ['category' => 'Events & Programs', 'question' => 'Are events free for residents?', 'answer' => 'Most community events are free for residents. Some special programs may have fees, which will be clearly indicated in the event details.'],
                ['category' => 'Contact', 'question' => 'How can I contact the barangay office?', 'answer' => 'You can contact us at (02) 123-4567, email us at info@communityhub.ph, or visit the barangay hall at [Address] during office hours.'],
            ];
        @endphp

        @foreach($faqs as $index => $faq)
        <div class="modern-card p-6" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
            <div class="mb-2">
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-beige-light text-text-secondary">{{ $faq['category'] }}</span>
            </div>
            <h3 class="text-xl font-bold text-text-primary mb-3">{{ $faq['question'] }}</h3>
            <p class="text-text-secondary leading-relaxed">{{ $faq['answer'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection

