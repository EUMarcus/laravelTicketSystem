@extends('layouts.app')

@section('title', 'Announcement - Community Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6" data-aos="fade-down">
        <a href="{{ route('announcements.index') }}" class="inline-flex items-center space-x-2 text-text-secondary hover:text-primary transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Announcements</span>
        </a>
    </div>

    <div class="modern-card p-6 lg:p-8" data-aos="fade-up">
        <div class="mb-6">
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-beige-light text-text-secondary mb-4 inline-block">
                Event
            </span>
            <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-4">Community Clean-Up Day Scheduled</h1>
            <p class="text-text-muted">Published on December 5, 2024</p>
        </div>

        <div class="prose max-w-none mb-6">
            <p class="text-text-secondary leading-relaxed text-lg mb-4">
                We are excited to announce our upcoming Community Clean-Up Day scheduled for Saturday, December 14, 2024, from 8:00 AM to 12:00 PM.
            </p>
            <p class="text-text-secondary leading-relaxed mb-4">
                This is a community-wide initiative to clean and beautify our barangay. All residents are warmly invited to participate in this activity. Together, we can make our community a cleaner and more beautiful place to live.
            </p>
            <p class="text-text-secondary leading-relaxed mb-4">
                <strong>What to bring:</strong>
            </p>
            <ul class="list-disc list-inside text-text-secondary space-y-2 mb-4">
                <li>Gloves and protective gear</li>
                <li>Garbage bags</li>
                <li>Your enthusiasm and positive energy!</li>
            </ul>
            <p class="text-text-secondary leading-relaxed">
                Light refreshments will be provided. For more information, please contact the barangay office.
            </p>
        </div>
    </div>
</div>
@endsection

