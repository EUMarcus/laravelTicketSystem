@extends('layouts.app')

@section('title', 'Home - Barangay Community Hub')

@section('content')
<!-- Hero Section - Enhanced with Parallax Effect -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden mb-16" style="position: relative !important; z-index: 1 !important; background: transparent !important; background-color: transparent !important; margin-top: 0 !important; padding-top: 0 !important; max-width: 100vw !important; width: 100% !important; overflow: hidden !important;">
    <!-- Background Image with Parallax -->
    <div class="absolute inset-0" style="z-index: 0 !important; position: absolute !important;">
        <img 
            src="{{ asset('images/backgrounds/peoplestaff.jpg') }}" 
            alt="Community" 
            class="w-full h-full object-cover hero-parallax"
            style="display: block !important; visibility: visible !important; opacity: 1 !important; width: 100% !important; height: 100% !important; object-fit: cover !important; position: absolute !important; top: 0 !important; left: 0 !important; z-index: 0 !important;"
        >
        <!-- Enhanced Dark Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black/60" style="z-index: 1 !important; position: absolute !important;"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent" style="z-index: 2 !important; position: absolute !important;"></div>
    </div>

    <!-- Snowfall Canvas -->
    <canvas id="snowfall-canvas" class="absolute inset-0 pointer-events-none" style="z-index: 6 !important; position: absolute !important; width: 100%; height: 100%;"></canvas>

    <!-- Hero Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center" style="z-index: 10 !important; position: relative !important; padding-top: 5rem !important; opacity: 1 !important; visibility: visible !important;">
        <div class="mb-8" style="visibility: visible !important; opacity: 1 !important;">
            <div class="inline-block relative">
                <div class="relative inline-block p-3 bg-white/10 backdrop-blur-md rounded-full border-2 border-white/30" style="z-index: 10 !important;">
                    <img src="{{ asset('Logo/sklogo.png') }}" alt="Logo" class="h-16 w-16 rounded-full object-cover" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                </div>
            </div>
        </div>
        
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 drop-shadow-2xl" style="color: white !important; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8) !important; opacity: 1 !important; visibility: visible !important; transform: translateY(0) !important;">
            Welcome to <span class="block mt-3 bg-gradient-to-r from-white via-[#C1F2B0] to-white bg-clip-text text-transparent" style="-webkit-text-fill-color: white !important; background-clip: text !important; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8) !important;">Barangay Community Hub</span>
            </h1>
        
        <p class="text-lg md:text-xl mb-12 max-w-2xl mx-auto leading-relaxed" style="color: rgba(255, 255, 255, 0.95) !important; text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8) !important; opacity: 1 !important; visibility: visible !important; transform: translateY(0) !important;">
            A progressive community, dedicated to genuine service to enrich the lives of its residents through good governance.
            </p>
        
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4" style="opacity: 1 !important; visibility: visible !important; transform: translateY(0) !important;">
            <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-gray-900 text-white font-bold rounded-lg shadow-lg hover:bg-gray-800">
                <span>Know More</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
            </a>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white" style="background-color: #ffffff !important; position: relative; z-index: 2; overflow: visible !important; padding-top: 2rem !important;">
    <!-- Main Services Section -->
    <div class="mb-16">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Community Services</h2>
            <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mx-auto mb-4"></div>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">Access essential services and resources for our community</p>
        </div>
        
        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $services = [
                    ['route' => 'reports.index', 'title' => 'Submit Reports', 'desc' => 'Report community issues and track their progress', 'color' => '65B741'],
                    ['route' => 'suggestions.index', 'title' => 'Share Suggestions', 'desc' => 'Share ideas and participate in community discussions', 'color' => 'FFB534'],
                    ['route' => 'announcements.index', 'title' => 'Announcements', 'desc' => 'Stay updated with important community news', 'color' => '65B741'],
                    ['route' => 'faq.index', 'title' => 'FAQ', 'desc' => 'Find answers to frequently asked questions', 'color' => 'FFB534'],
                ];
            @endphp
            
            @foreach($services as $service)
            <a href="{{ route($service['route']) }}" class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:border-gray-300 hover:shadow-md h-full flex flex-col group">
                <div class="flex items-start justify-between mb-4">
                    <div class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 border border-gray-200">
                        <span class="text-lg font-bold text-gray-900">{{ $loop->iteration }}</span>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                
                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-gray-700">{{ $service['title'] }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow">{{ $service['desc'] }}</p>
                    
                <div class="flex items-center text-[#{{ $service['color'] }}] font-semibold text-sm mt-auto">
                        <span>Learn More</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Quick Links Section -->
    <div class="grid md:grid-cols-2 gap-6 mb-16">
        <!-- Latest Reports -->
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Latest Reports</h2>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-[#65B741]/10 text-[#65B741] border border-[#65B741]/20">5 New</span>
            </div>
            <div class="space-y-3 mb-6">
                @php
                    $reports = [
                        ['id' => 1, 'title' => 'Broken Streetlight on Main Street', 'status' => 'In Progress', 'date' => '2 days ago'],
                        ['id' => 2, 'title' => 'Pothole Near Community Center', 'status' => 'Under Review', 'date' => '3 days ago'],
                        ['id' => 3, 'title' => 'Garbage Collection Issue', 'status' => 'Completed', 'date' => '1 week ago'],
                        ['id' => 4, 'title' => 'Flooding in Barangay Road', 'status' => 'Open', 'date' => '1 week ago'],
                        ['id' => 5, 'title' => 'Stray Dogs in Park Area', 'status' => 'In Progress', 'date' => '2 weeks ago'],
                    ];
                @endphp
                @foreach($reports as $index => $report)
                <a href="{{ route('reports.show', $report['id']) }}" class="block p-4 rounded-lg bg-gray-50 border border-gray-200 hover:border-gray-300 hover:bg-white group">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">{{ $report['title'] }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                            @if($report['status'] === 'Open') bg-[#65B741]/10 text-[#65B741] border border-[#65B741]/20
                            @elseif($report['status'] === 'In Progress') bg-[#FFB534]/10 text-[#FFB534] border border-[#FFB534]/20
                            @elseif($report['status'] === 'Completed') bg-gray-100 text-gray-700 border border-gray-200
                            @else bg-gray-100 text-gray-600 border border-gray-200 @endif ml-2 flex-shrink-0">
                            {{ $report['status'] }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $report['date'] }}
                    </p>
                </a>
                @endforeach
            </div>
            <a href="{{ route('reports.index') }}" class="block text-center text-gray-900 font-bold text-sm hover:text-gray-700">
                View All Reports
                <svg class="w-4 h-4 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Latest Announcements -->
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Latest Announcements</h2>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-[#FFB534]/10 text-[#FFB534] border border-[#FFB534]/20">5 New</span>
            </div>
            <div class="space-y-3 mb-6">
                @php
                    $announcements = [
                        ['id' => 1, 'title' => 'Community Clean-Up Day Scheduled', 'category' => 'Event', 'date' => '1 day ago'],
                        ['id' => 2, 'title' => 'Health Advisory: Dengue Prevention', 'category' => 'Health', 'date' => '3 days ago'],
                        ['id' => 3, 'title' => 'Barangay Meeting This Saturday', 'category' => 'Meeting', 'date' => '5 days ago'],
                        ['id' => 4, 'title' => 'Free Medical Check-Up Available', 'category' => 'Health', 'date' => '1 week ago'],
                        ['id' => 5, 'title' => 'New Year Festival Preparations', 'category' => 'Event', 'date' => '1 week ago'],
                    ];
                @endphp
                @foreach($announcements as $index => $announcement)
                <a href="{{ route('announcements.show', $announcement['id']) }}" class="block p-4 rounded-lg bg-gray-50 border border-gray-200 hover:border-gray-300 hover:bg-white group">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">{{ $announcement['title'] }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200 ml-2 flex-shrink-0">
                            {{ $announcement['category'] }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $announcement['date'] }}
                    </p>
                </a>
                @endforeach
            </div>
            <a href="{{ route('announcements.index') }}" class="block text-center text-gray-900 font-bold text-sm hover:text-gray-700">
                View All Announcements
                <svg class="w-4 h-4 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Upcoming Events Section -->
    <section class="mb-16">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Upcoming Events</h2>
            <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mx-auto mb-4"></div>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">Join us for exciting community activities</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @php
                $events = [
                    ['id' => 1, 'title' => 'Community Clean-Up Day', 'date' => 'Dec 14, 2024', 'time' => '8:00 AM - 12:00 PM', 'location' => 'Community Park', 'category' => 'Community', 'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=400&h=300&fit=crop'],
                    ['id' => 2, 'title' => 'Free Health Check-Up', 'date' => 'Dec 21, 2024', 'time' => '9:00 AM - 3:00 PM', 'location' => 'Community Center', 'category' => 'Health', 'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'],
                    ['id' => 3, 'title' => 'New Year Community Festival', 'date' => 'Jan 1, 2025', 'time' => '5:00 PM - 12:00 AM', 'location' => 'Main Square', 'category' => 'Celebration', 'image' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=400&h=300&fit=crop'],
                ];
            @endphp
            @foreach($events as $index => $event)
            <a href="{{ route('announcements.show', $event['id']) }}" class="block bg-white rounded-lg border border-gray-200 shadow-sm hover:border-gray-300 hover:shadow-md overflow-hidden group">
                <!-- Event Image -->
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-white/90 backdrop-blur-sm text-gray-800 border border-gray-200 shadow-sm">{{ $event['category'] }}</span>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-lg font-bold text-white mb-1 drop-shadow-lg line-clamp-2">{{ $event['title'] }}</h3>
                    </div>
                </div>
                
                <div class="p-5">
                    <div class="space-y-2 text-sm text-gray-600">
                        <div class="font-medium">{{ $event['date'] }} • {{ $event['time'] }}</div>
                        <div class="flex items-center">
                            <svg class="w-3.5 h-3.5 text-gray-500 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            <span>{{ $event['location'] }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('announcements.index') }}" class="inline-flex items-center gap-2 text-gray-900 font-bold text-base hover:text-gray-700">
                <span>View All News & Events</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </section>
</div>
@endsection
