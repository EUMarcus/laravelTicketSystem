@extends('layouts.app')

@section('title', 'Events - Staff Dashboard')

@section('content')
@if(session('user') && session('user')['role'] === 'employee')
<div class="flex min-h-screen" style="padding-top: 4rem;">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 fixed left-0 top-16 h-[calc(100vh-4rem)] overflow-y-auto z-40">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Staff Dashboard</h2>
            
            <nav class="space-y-2">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.dashboard') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Overview</span>
                </a>
                
                <div class="pt-4">
                    <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Manage</h3>
                    
                    <a href="{{ route('staff.reports') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.reports') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="font-medium">Reports</span>
                    </a>
                    
                    <a href="{{ route('staff.suggestions') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.suggestions') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <span class="font-medium">Suggestions</span>
                    </a>
                    
                    <a href="{{ route('staff.announcements') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.announcements') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                        <span class="font-medium">Announcements</span>
                    </a>
                    
                    <a href="{{ route('staff.events') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.events') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">Events</span>
                    </a>
                    
                    <a href="{{ route('staff.polls') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.polls') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-medium">Polls</span>
                    </a>
                </div>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-10">
                <div class="mb-8">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Events & Calendar</h1>
                    <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                    <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Stay updated with upcoming community activities and events</p>
                </div>
            </div>

            <!-- Events Grid -->
            @php
                $allEvents = [
                    ['id' => 1, 'title' => 'Community Clean-Up Day', 'date' => 'Dec 14, 2024', 'time' => '8:00 AM - 12:00 PM', 'location' => 'Community Park', 'category' => 'Community', 'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800'],
                    ['id' => 2, 'title' => 'Free Health Check-Up', 'date' => 'Dec 21, 2024', 'time' => '9:00 AM - 3:00 PM', 'location' => 'Community Center', 'category' => 'Health', 'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800'],
                    ['id' => 3, 'title' => 'New Year Community Festival', 'date' => 'Jan 1, 2025', 'time' => '5:00 PM - 12:00 AM', 'location' => 'Main Square', 'category' => 'Celebration', 'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800'],
                    ['id' => 4, 'title' => 'Digital Literacy Workshop', 'date' => 'Jan 5, 2025', 'time' => '10:00 AM - 2:00 PM', 'location' => 'Computer Lab', 'category' => 'Workshop', 'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800'],
                    ['id' => 5, 'title' => 'Basketball Tournament', 'date' => 'Jan 12, 2025', 'time' => '8:00 AM - 6:00 PM', 'location' => 'Sports Complex', 'category' => 'Sports', 'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800'],
                    ['id' => 6, 'title' => 'Monthly Community Meeting', 'date' => 'Dec 10, 2024', 'time' => '6:00 PM - 8:00 PM', 'location' => 'Community Hall', 'category' => 'Meeting', 'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800'],
                    ['id' => 7, 'title' => 'Youth Sports Day', 'date' => 'Jan 15, 2025', 'time' => '9:00 AM - 4:00 PM', 'location' => 'Sports Complex', 'category' => 'Sports', 'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800'],
                    ['id' => 8, 'title' => 'Cooking Class for Seniors', 'date' => 'Jan 8, 2025', 'time' => '2:00 PM - 4:00 PM', 'location' => 'Community Kitchen', 'category' => 'Workshop', 'image' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800'],
                    ['id' => 9, 'title' => 'Art & Craft Fair', 'date' => 'Jan 20, 2025', 'time' => '10:00 AM - 6:00 PM', 'location' => 'Community Center', 'category' => 'Community', 'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800'],
                    ['id' => 10, 'title' => 'Blood Donation Drive', 'date' => 'Dec 18, 2024', 'time' => '8:00 AM - 2:00 PM', 'location' => 'Community Center', 'category' => 'Health', 'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800'],
                    ['id' => 11, 'title' => 'Christmas Caroling', 'date' => 'Dec 24, 2024', 'time' => '6:00 PM - 9:00 PM', 'location' => 'Main Square', 'category' => 'Celebration', 'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800'],
                    ['id' => 12, 'title' => 'Environmental Awareness Seminar', 'date' => 'Jan 25, 2025', 'time' => '1:00 PM - 3:00 PM', 'location' => 'Community Hall', 'category' => 'Workshop', 'image' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800'],
                ];

                // Paginate
                $perPage = 6;
                $currentPage = request('page', 1);
                $total = count($allEvents);
                $offset = ($currentPage - 1) * $perPage;
                $events = array_slice($allEvents, $offset, $perPage);
                
                // Create paginator
                $events = new \Illuminate\Pagination\LengthAwarePaginator(
                    $events,
                    $total,
                    $perPage,
                    $currentPage,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
            @endphp

            @if(count($events) > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    @foreach($events as $event)
                        <a href="{{ route('events.show', $event['id']) }}" class="block group">
                            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden h-full flex flex-col hover:border-gray-300 hover:shadow-md">
                                <!-- Event Image -->
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    <div class="absolute top-4 left-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-white/90 backdrop-blur-sm text-gray-800 border border-gray-200 shadow-sm">
                                            {{ $event['category'] }}
                                        </span>
                                    </div>
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <h3 class="text-lg font-bold text-white mb-1 drop-shadow-lg line-clamp-2">{{ $event['title'] }}</h3>
                                    </div>
                                </div>
                                
                                <div class="p-5 flex-1 flex flex-col">
                                    <div class="space-y-2 mb-4 flex-grow">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="font-medium">{{ $event['date'] }} • {{ $event['time'] }}</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            </svg>
                                            <span class="font-medium">{{ $event['location'] }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="pt-4 border-t border-gray-100">
                                        <span class="text-xs font-semibold text-gray-700 group-hover:text-gray-900">View Details →</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($events->hasPages())
                    <div class="flex justify-center mt-6">
                        <div class="flex items-center gap-2">
                            @if($events->onFirstPage())
                                <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $events->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Previous</a>
                            @endif

                            @foreach($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                                @if($page == $events->currentPage())
                                    <span class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if($events->hasMorePages())
                                <a href="{{ $events->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</a>
                            @else
                                <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No events found.</p>
                </div>
            @endif
        </div>
    </main>
</div>
@else
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-8 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Access Denied</h2>
        <p class="text-gray-600 mb-6">You need to be logged in as staff to access this page.</p>
        <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-[#65B741] text-white font-semibold rounded-lg hover:bg-[#4d8a32]">
            Go to Login
        </a>
    </div>
</div>
@endif
@endsection

