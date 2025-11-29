@extends('layouts.app')

@section('title', 'Events & Calendar - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8" data-aos="fade-down">
        <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">Community Events & Calendar</h1>
        <p class="text-text-secondary">Stay updated with upcoming community activities</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $events = [
                ['id' => 1, 'title' => 'Community Clean-Up Day', 'date' => 'Dec 14, 2024', 'time' => '8:00 AM - 12:00 PM', 'location' => 'Community Park', 'category' => 'Community'],
                ['id' => 2, 'title' => 'Free Health Check-Up', 'date' => 'Dec 21, 2024', 'time' => '9:00 AM - 3:00 PM', 'location' => 'Community Center', 'category' => 'Health'],
                ['id' => 3, 'title' => 'New Year Community Festival', 'date' => 'Jan 1, 2025', 'time' => '5:00 PM - 12:00 AM', 'location' => 'Main Square', 'category' => 'Celebration'],
                ['id' => 4, 'title' => 'Digital Literacy Workshop', 'date' => 'Jan 5, 2025', 'time' => '10:00 AM - 2:00 PM', 'location' => 'Computer Lab', 'category' => 'Workshop'],
                ['id' => 5, 'title' => 'Basketball Tournament', 'date' => 'Jan 12, 2025', 'time' => '8:00 AM - 6:00 PM', 'location' => 'Sports Complex', 'category' => 'Sports'],
                ['id' => 6, 'title' => 'Monthly Community Meeting', 'date' => 'Dec 10, 2024', 'time' => '6:00 PM - 8:00 PM', 'location' => 'Community Hall', 'category' => 'Meeting'],
            ];
        @endphp

        @foreach($events as $event)
        <a href="{{ route('events.show', $event['id']) }}" class="block group">
            <div class="modern-card p-6 hover-lift" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-beige-light text-text-secondary">{{ $event['category'] }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-text-primary mb-2 group-hover:text-primary transition-colors">{{ $event['title'] }}</h3>
                </div>
                <div class="space-y-2 border-t border-gray-200 pt-4">
                    <div class="flex items-center text-sm text-text-secondary">
                        <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $event['date'] }}</span>
                    </div>
                    <div class="flex items-center text-sm text-text-secondary">
                        <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $event['time'] }}</span>
                    </div>
                    <div class="flex items-center text-sm text-text-secondary">
                        <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <span>{{ $event['location'] }}</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection

