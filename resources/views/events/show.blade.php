@extends('layouts.app')

@section('title', 'Event Details - Community Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6" data-aos="fade-down">
        <a href="{{ route('events.index') }}" class="inline-flex items-center space-x-2 text-text-secondary hover:text-primary transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Events</span>
        </a>
    </div>

    <div class="modern-card p-6 lg:p-8" data-aos="fade-up">
        <div class="mb-6">
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-beige-light text-text-secondary mb-4 inline-block">
                Community
            </span>
            <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-4">Community Clean-Up Day</h1>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="font-semibold text-text-primary mb-2">Date & Time</h3>
                <p class="text-text-secondary">December 14, 2024</p>
                <p class="text-text-secondary">8:00 AM - 12:00 PM</p>
            </div>
            <div>
                <h3 class="font-semibold text-text-primary mb-2">Location</h3>
                <p class="text-text-secondary">Community Park</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-text-primary mb-3">Event Description</h3>
            <p class="text-text-secondary leading-relaxed mb-4">
                Join us for a community-wide clean-up activity to beautify our barangay. All residents are welcome to participate in this initiative.
            </p>
            <p class="text-text-secondary leading-relaxed">
                <strong>What to bring:</strong> Gloves, garbage bags, and your enthusiasm! Light refreshments will be provided.
            </p>
        </div>
    </div>
</div>
@endsection

