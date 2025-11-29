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

    <!-- Floating Particles Effect - Enhanced -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none" style="z-index: 5 !important; position: absolute !important;">
        <div class="particle absolute w-2 h-2 bg-white/20 rounded-full animate-float" style="left: 15%; top: 25%; animation-delay: 0s;"></div>
        <div class="particle absolute w-3 h-3 bg-white/15 rounded-full animate-float-reverse" style="left: 65%; top: 45%; animation-delay: 0.5s;"></div>
        <div class="particle absolute w-2 h-2 bg-white/25 rounded-full animate-float" style="left: 85%; top: 15%; animation-delay: 1s;"></div>
        <div class="particle absolute w-3 h-3 bg-white/12 rounded-full animate-float-reverse" style="left: 35%; top: 75%; animation-delay: 1.5s;"></div>
        <div class="particle absolute w-2 h-2 bg-white/18 rounded-full animate-float" style="left: 75%; top: 65%; animation-delay: 2s;"></div>
        <div class="particle absolute w-2.5 h-2.5 bg-white/20 rounded-full animate-float-reverse" style="left: 25%; top: 55%; animation-delay: 2.5s;"></div>
                </div>

    <!-- Snowfall Canvas -->
    <canvas id="snowfall-canvas" class="absolute inset-0 pointer-events-none" style="z-index: 6 !important; position: absolute !important; width: 100%; height: 100%;"></canvas>

    <!-- Hero Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center" style="z-index: 10 !important; position: relative !important; padding-top: 5rem !important; opacity: 1 !important; visibility: visible !important;">
        <div class="mb-8" data-aos="zoom-in" data-aos-duration="1000" style="visibility: visible !important; opacity: 1 !important;">
            <div class="inline-block relative">
                <div class="absolute inset-0 bg-white/20 rounded-full blur-xl animate-pulse"></div>
                <div class="relative inline-block p-3 bg-white/10 backdrop-blur-md rounded-full border-2 border-white/30" style="z-index: 10 !important;">
                    <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Logo" class="h-16 w-16 rounded-full object-cover" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                </div>
            </div>
        </div>
        
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 drop-shadow-2xl" style="color: white !important; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8) !important; opacity: 1 !important; visibility: visible !important; transform: translateY(0) !important;" data-aos="fade-up" data-aos-delay="100">
            Welcome to <span class="block mt-3 bg-gradient-to-r from-white via-[#C1F2B0] to-white bg-clip-text text-transparent animate-gradient" style="-webkit-text-fill-color: white !important; background-clip: text !important; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8) !important;">Barangay Community Hub</span>
            </h1>
        
        <p class="text-lg md:text-xl mb-12 max-w-2xl mx-auto leading-relaxed" style="color: rgba(255, 255, 255, 0.95) !important; text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8) !important; opacity: 1 !important; visibility: visible !important; transform: translateY(0) !important;" data-aos="fade-up" data-aos-delay="200">
            A progressive community, dedicated to genuine service to enrich the lives of its residents through good governance.
            </p>
        
        <div class="flex flex-col sm:flex-row justify-center items-center gap-5" style="opacity: 1 !important; visibility: visible !important; transform: translateY(0) !important;" data-aos="fade-up" data-aos-delay="300">
            <a href="{{ route('reports.index') }}" class="group magnetic ripple-container relative bg-white text-gray-900 font-bold px-10 py-4 rounded-xl hover:scale-105 text-lg overflow-hidden shadow-2xl animate-breathe">
                <span class="relative z-10 flex items-center">
                    KNOW MORE
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-gray-100 via-white to-gray-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute inset-0 animate-shimmer"></div>
            </a>
            <a href="{{ route('events.index') }}" class="group magnetic ripple-container relative bg-transparent border-2 border-white/80 text-white font-bold px-10 py-4 rounded-xl hover:bg-white/10 hover:scale-105 text-lg backdrop-blur-sm glass-effect">
                <span class="flex items-center">
                    CALENDAR OF ACTIVITIES
                    <svg class="w-5 h-5 ml-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white" style="background-color: #ffffff !important; position: relative; z-index: 2; overflow: visible !important; padding-top: 2rem !important;">
    <!-- Quick Stats - Enhanced with Gradient Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-24 relative z-20" style="margin-top: -4rem !important; min-height: auto !important; overflow: visible !important; padding-top: 2rem !important;">
        <div class="stat-card group relative bg-white p-8 rounded-2xl shadow-xl border border-gray-200 text-center hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 perspective-1000" style="min-height: 180px !important; overflow: visible !important; display: flex !important; flex-direction: column !important; justify-content: center !important;" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute inset-0 bg-gradient-to-br from-[#65B741]/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
                <div class="text-5xl font-bold mb-3 bg-gradient-to-br from-[#65B741] to-[#4d8a32] bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-500">142</div>
                <div class="text-gray-600 font-semibold">Total Reports</div>
                <div class="mt-4 h-1 w-0 group-hover:w-full bg-gradient-to-r from-[#65B741] to-[#C1F2B0] transition-all duration-500 rounded-full"></div>
            </div>
        </div>
        
        <div class="stat-card group relative bg-white p-8 rounded-2xl shadow-xl border border-gray-200 text-center hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 perspective-1000" style="min-height: 180px !important; overflow: visible !important; display: flex !important; flex-direction: column !important; justify-content: center !important;" data-aos="fade-up" data-aos-delay="200">
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFB534]/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
                <div class="text-5xl font-bold mb-3 bg-gradient-to-br from-[#FFB534] to-[#ff9d00] bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-500">23</div>
                <div class="text-gray-600 font-semibold">Open Reports</div>
                <div class="mt-4 h-1 w-0 group-hover:w-full bg-gradient-to-r from-[#FFB534] to-[#ffe6b8] transition-all duration-500 rounded-full"></div>
            </div>
        </div>

        <div class="stat-card group relative bg-white p-8 rounded-2xl shadow-xl border border-gray-200 text-center hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 perspective-1000" style="min-height: 180px !important; overflow: visible !important; display: flex !important; flex-direction: column !important; justify-content: center !important;" data-aos="fade-up" data-aos-delay="300">
            <div class="absolute inset-0 bg-gradient-to-br from-[#65B741]/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
                <div class="text-5xl font-bold mb-3 bg-gradient-to-br from-[#65B741] to-[#4d8a32] bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-500">89</div>
                <div class="text-gray-600 font-semibold">Suggestions</div>
                <div class="mt-4 h-1 w-0 group-hover:w-full bg-gradient-to-r from-[#65B741] to-[#C1F2B0] transition-all duration-500 rounded-full"></div>
            </div>
                </div>
        
        <div class="stat-card group relative bg-white p-8 rounded-2xl shadow-xl border border-gray-200 text-center hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 perspective-1000" style="min-height: 180px !important; overflow: visible !important; display: flex !important; flex-direction: column !important; justify-content: center !important;" data-aos="fade-up" data-aos-delay="400">
            <div class="absolute inset-0 bg-gradient-to-br from-[#65B741]/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
                <div class="text-5xl font-bold mb-3 bg-gradient-to-br from-[#65B741] to-[#4d8a32] bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-500">6</div>
                <div class="text-gray-600 font-semibold">Upcoming Events</div>
                <div class="mt-4 h-1 w-0 group-hover:w-full bg-gradient-to-r from-[#65B741] to-[#C1F2B0] transition-all duration-500 rounded-full"></div>
            </div>
        </div>
    </div>

    <!-- Main Services Section - Enhanced Cards -->
    <div class="mb-24" style="margin-top: 5rem !important;">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Community Services</h2>
            <div class="w-32 h-1.5 bg-gradient-to-r from-[#FFB534] via-[#FFB534] to-transparent mx-auto mb-6 rounded-full"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Access essential services and resources for our community</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $services = [
                    ['route' => 'reports.index', 'title' => 'Submit Reports', 'desc' => 'Report community issues and track their progress', 'color' => '65B741', 'delay' => 100],
                    ['route' => 'suggestions.index', 'title' => 'Share Suggestions', 'desc' => 'Share ideas and participate in community discussions', 'color' => 'FFB534', 'delay' => 200],
                    ['route' => 'announcements.index', 'title' => 'Announcements', 'desc' => 'Stay updated with important community news', 'color' => '65B741', 'delay' => 300],
                    ['route' => 'events.index', 'title' => 'Events & Calendar', 'desc' => 'View upcoming community events and activities', 'color' => '65B741', 'delay' => 400],
                    ['route' => 'polls.index', 'title' => 'Community Polls', 'desc' => 'Participate in community decisions and votes', 'color' => '65B741', 'delay' => 500],
                    ['route' => 'faq.index', 'title' => 'FAQ', 'desc' => 'Find answers to frequently asked questions', 'color' => 'FFB534', 'delay' => 600],
                ];
            @endphp
            
            @foreach($services as $service)
            <a href="{{ route($service['route']) }}" class="service-card group magnetic relative bg-white p-8 rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden perspective-1000 transform-3d" data-aos="fade-up" data-aos-delay="{{ $service['delay'] }}">
                <!-- Gradient Background on Hover -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#{{ $service['color'] }}]/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <!-- Animated Border -->
                <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-[#{{ $service['color'] }}] via-transparent to-[#{{ $service['color'] }}] opacity-20" style="mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); mask-composite: exclude; padding: 2px;"></div>
                </div>
                
                <div class="relative z-10">
                    <!-- Number Badge -->
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#{{ $service['color'] }}]/10 to-[#{{ $service['color'] }}]/5 mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <span class="text-xl font-bold text-[#{{ $service['color'] }}]">{{ $loop->iteration }}</span>
            </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#{{ $service['color'] }}] transition-colors duration-300">{{ $service['title'] }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">{{ $service['desc'] }}</p>
                    
                    <div class="flex items-center text-[#{{ $service['color'] }}] font-semibold text-sm group-hover:translate-x-2 transition-transform duration-300">
                        <span>Learn More</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Quick Links Section - Enhanced Design -->
    <div class="grid md:grid-cols-2 gap-8 mb-24">
        <!-- Latest Reports -->
        <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-2xl shadow-xl border border-gray-200 overflow-hidden" data-aos="fade-right">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <span class="w-1 h-8 bg-gradient-to-b from-[#65B741] to-[#4d8a32] rounded-full mr-3"></span>
                    Latest Reports
                </h2>
                <span class="px-3 py-1 text-xs font-bold rounded-full bg-[#65B741]/10 text-[#65B741]">5 New</span>
            </div>
            <div class="space-y-3">
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
                <a href="{{ route('reports.show', $report['id']) }}" class="group block p-5 rounded-xl bg-white hover:bg-gradient-to-r hover:from-[#65B741]/5 hover:to-transparent border border-gray-200 hover:border-[#65B741]/30 hover:shadow-md transition-all duration-300" data-aos="fade-right" data-aos-delay="{{ ($index + 1) * 50 }}">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-gray-900 text-sm group-hover:text-[#65B741] transition-colors">{{ $report['title'] }}</h3>
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 group-hover:bg-[#65B741]/10 text-gray-700 group-hover:text-[#65B741] transition-colors border border-gray-200 group-hover:border-[#65B741]/30">
                            {{ $report['status'] }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $report['date'] }}
                    </p>
                </a>
                @endforeach
            </div>
            <a href="{{ route('reports.index') }}" class="block mt-6 text-center text-[#65B741] hover:text-[#4d8a32] font-bold text-sm group">
                View All Reports
                <svg class="w-4 h-4 inline-block ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Latest Announcements -->
        <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-2xl shadow-xl border border-gray-200 overflow-hidden" data-aos="fade-left">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <span class="w-1 h-8 bg-gradient-to-b from-[#FFB534] to-[#ff9d00] rounded-full mr-3"></span>
                    Latest Announcements
                </h2>
                <span class="px-3 py-1 text-xs font-bold rounded-full bg-[#FFB534]/10 text-[#FFB534]">5 New</span>
            </div>
            <div class="space-y-3">
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
                <a href="{{ route('announcements.show', $announcement['id']) }}" class="group block p-5 rounded-xl bg-white hover:bg-gradient-to-r hover:from-[#FFB534]/5 hover:to-transparent border border-gray-200 hover:border-[#FFB534]/30 hover:shadow-md transition-all duration-300" data-aos="fade-left" data-aos-delay="{{ ($index + 1) * 50 }}">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-gray-900 text-sm group-hover:text-[#FFB534] transition-colors">{{ $announcement['title'] }}</h3>
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 group-hover:bg-[#FFB534]/10 text-gray-700 group-hover:text-[#FFB534] transition-colors border border-gray-200 group-hover:border-[#FFB534]/30">
                            {{ $announcement['category'] }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $announcement['date'] }}
                    </p>
                </a>
                @endforeach
            </div>
            <a href="{{ route('announcements.index') }}" class="block mt-6 text-center text-[#FFB534] hover:text-[#ff9d00] font-bold text-sm group">
                View All Announcements
                <svg class="w-4 h-4 inline-block ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Upcoming Events Section - Enhanced Cards -->
    <section class="mb-24" style="overflow: visible !important; max-height: none !important;">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Upcoming Events</h2>
            <div class="w-32 h-1.5 bg-gradient-to-r from-[#FFB534] via-[#FFB534] to-transparent mx-auto mb-6 rounded-full"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Join us for exciting community activities</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8" style="overflow: visible !important; max-height: none !important;">
            @php
                $events = [
                    ['id' => 1, 'title' => 'Community Clean-Up Day', 'date' => 'Dec 14, 2024', 'time' => '8:00 AM - 12:00 PM', 'location' => 'Community Park', 'category' => 'Community', 'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=400&h=300&fit=crop'],
                    ['id' => 2, 'title' => 'Free Health Check-Up', 'date' => 'Dec 21, 2024', 'time' => '9:00 AM - 3:00 PM', 'location' => 'Community Center', 'category' => 'Health', 'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'],
                    ['id' => 3, 'title' => 'New Year Community Festival', 'date' => 'Jan 1, 2025', 'time' => '5:00 PM - 12:00 AM', 'location' => 'Main Square', 'category' => 'Celebration', 'image' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=400&h=300&fit=crop'],
                ];
            @endphp
            @foreach($events as $index => $event)
            <div class="group relative bg-white rounded-2xl shadow-xl border border-gray-200 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500" style="overflow: visible !important; max-height: none !important; height: auto !important;" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <!-- Event Image -->
                <div class="relative h-48" style="overflow: hidden !important;">
                    <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-xs font-bold text-gray-800 shadow-lg">{{ $event['category'] }}</span>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-bold text-white mb-1 drop-shadow-lg">{{ $event['title'] }}</h3>
                    </div>
                </div>
                
                <div class="p-6" style="overflow: visible !important;">
                    <div class="space-y-3 mb-6" style="overflow: visible !important;">
                        <div class="flex items-center text-sm text-gray-600">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#65B741]/10 to-[#65B741]/5 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="font-semibold">{{ $event['date'] }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#65B741]/10 to-[#65B741]/5 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="font-semibold">{{ $event['time'] }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#65B741]/10 to-[#65B741]/5 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                            <span class="font-semibold">{{ $event['location'] }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('events.show', $event['id']) }}" class="block w-full text-center bg-gradient-to-r from-[#65B741] to-[#4d8a32] text-white py-3 rounded-xl font-bold hover:from-[#4d8a32] hover:to-[#65B741] transition-all duration-300 shadow-lg hover:shadow-xl group">
                        View Details
                        <svg class="w-5 h-5 inline-block ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('events.index') }}" class="inline-flex items-center space-x-2 text-[#65B741] hover:text-[#4d8a32] font-bold text-lg transition-colors group">
                <span>View All Events</span>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </section>
</div>
@endsection
