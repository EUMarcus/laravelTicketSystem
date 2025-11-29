@extends('layouts.app')

@section('title', 'Announcements - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8" data-aos="fade-down">
        <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">Barangay Announcements</h1>
        <p class="text-text-secondary">Stay informed with the latest community updates</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $announcements = [
                ['id' => 1, 'title' => 'Community Clean-Up Day Scheduled', 'category' => 'Event', 'date' => 'Dec 5, 2024', 'summary' => 'Join us for a community-wide clean-up activity this coming Saturday. All residents are welcome to participate.'],
                ['id' => 2, 'title' => 'Health Advisory: Dengue Prevention', 'category' => 'Health', 'date' => 'Dec 3, 2024', 'summary' => 'Important reminders on preventing dengue. Keep your surroundings clean and eliminate stagnant water.'],
                ['id' => 3, 'title' => 'Barangay Meeting This Saturday', 'category' => 'Meeting', 'date' => 'Dec 1, 2024', 'summary' => 'Monthly barangay meeting scheduled. All residents are encouraged to attend and voice their concerns.'],
                ['id' => 4, 'title' => 'Free Medical Check-Up Available', 'category' => 'Health', 'date' => 'Nov 28, 2024', 'summary' => 'Free health screening for all community members. Blood pressure, BMI, and basic check-ups available.'],
                ['id' => 5, 'title' => 'New Year Festival Preparations', 'category' => 'Event', 'date' => 'Nov 25, 2024', 'summary' => 'Planning for the New Year community festival has started. Volunteers needed for organizing committee.'],
                ['id' => 6, 'title' => 'Water Interruption Notice', 'category' => 'Service', 'date' => 'Nov 22, 2024', 'summary' => 'Water service will be interrupted on December 10 for pipe maintenance. Please store water.'],
            ];
        @endphp

        @foreach($announcements as $announcement)
        <a href="{{ route('announcements.show', $announcement['id']) }}" class="block group">
            <div class="modern-card p-6 hover-lift h-full" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="mb-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-green-light-bg text-primary mb-3 inline-block">
                        {{ $announcement['category'] }}
                    </span>
                    <h3 class="text-xl font-bold text-text-primary mb-3 group-hover:text-primary transition-colors">
                        {{ $announcement['title'] }}
                    </h3>
                    <p class="text-text-secondary text-sm mb-4 line-clamp-3">
                        {{ $announcement['summary'] }}
                    </p>
                </div>
                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                    <span class="text-sm text-text-muted">{{ $announcement['date'] }}</span>
                    <span class="text-primary font-semibold text-sm group-hover:underline">Read More →</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection

