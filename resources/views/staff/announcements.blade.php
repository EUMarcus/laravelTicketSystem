@extends('layouts.app')

@section('title', 'Announcements - Staff Dashboard')

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
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Announcements</h1>
                <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Stay informed with the latest community updates and important notices</p>
            </div>
        </div>

        <!-- Announcements Grid -->
        @php
        $allAnnouncements = [
            ['id' => 1, 'title' => 'Community Clean-Up Day Scheduled', 'category' => 'Event', 'date' => 'Dec 5, 2024', 'summary' => 'Join us for a community-wide clean-up activity this coming Saturday. All residents are welcome to participate.', 'urgent' => false],
            ['id' => 2, 'title' => 'Health Advisory: Dengue Prevention', 'category' => 'Health', 'date' => 'Dec 3, 2024', 'summary' => 'Important reminders on preventing dengue. Keep your surroundings clean and eliminate stagnant water.', 'urgent' => true],
            ['id' => 3, 'title' => 'Barangay Meeting This Saturday', 'category' => 'Meeting', 'date' => 'Dec 1, 2024', 'summary' => 'Monthly barangay meeting scheduled. All residents are encouraged to attend and voice their concerns.', 'urgent' => false],
            ['id' => 4, 'title' => 'Free Medical Check-Up Available', 'category' => 'Health', 'date' => 'Nov 28, 2024', 'summary' => 'Free health screening for all community members. Blood pressure, BMI, and basic check-ups available.', 'urgent' => false],
            ['id' => 5, 'title' => 'New Year Festival Preparations', 'category' => 'Event', 'date' => 'Nov 25, 2024', 'summary' => 'Planning for the New Year community festival has started. Volunteers needed for organizing committee.', 'urgent' => false],
            ['id' => 6, 'title' => 'Water Interruption Notice', 'category' => 'Service', 'date' => 'Nov 22, 2024', 'summary' => 'Water service will be interrupted on December 10 for pipe maintenance. Please store water.', 'urgent' => true],
            ['id' => 7, 'title' => 'Road Repair Schedule', 'category' => 'Infrastructure', 'date' => 'Nov 20, 2024', 'summary' => 'Main street will undergo repairs from December 15-20. Alternative routes will be provided.', 'urgent' => false],
            ['id' => 8, 'title' => 'Holiday Safety Reminders', 'category' => 'Safety', 'date' => 'Nov 18, 2024', 'summary' => 'Important safety tips for the holiday season. Keep your homes secure and report suspicious activities.', 'urgent' => false],
            ['id' => 9, 'title' => 'Scholarship Program Applications', 'category' => 'Education', 'date' => 'Nov 15, 2024', 'summary' => 'Applications for community scholarship program are now open. Deadline: December 30, 2024.', 'urgent' => false],
            ['id' => 10, 'title' => 'Garbage Collection Schedule Change', 'category' => 'Service', 'date' => 'Nov 12, 2024', 'summary' => 'Garbage collection will be moved to Tuesday and Friday starting next week.', 'urgent' => false],
            ['id' => 11, 'title' => 'Community Garden Opening', 'category' => 'Event', 'date' => 'Nov 10, 2024', 'summary' => 'Our new community garden is now open! Residents can register for their own plot.', 'urgent' => false],
            ['id' => 12, 'title' => 'Emergency Contact Numbers', 'category' => 'Safety', 'date' => 'Nov 8, 2024', 'summary' => 'Updated emergency contact numbers for barangay office, police, and fire department.', 'urgent' => true],
        ];

        // Paginate
        $perPage = 6;
        $currentPage = request('page', 1);
        $total = count($allAnnouncements);
        $offset = ($currentPage - 1) * $perPage;
        $announcements = array_slice($allAnnouncements, $offset, $perPage);
        
        // Create paginator
        $announcements = new \Illuminate\Pagination\LengthAwarePaginator(
            $announcements,
            $total,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        @endphp

        @if(count($announcements) > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach($announcements as $announcement)
            <a href="{{ route('announcements.show', $announcement['id']) }}" class="block group">
                        <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm h-full flex flex-col hover:border-gray-300 hover:shadow-md">
                            <!-- Header -->
                    <div class="mb-4">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-base font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">
                                        {{ $announcement['title'] }}
                                    </h3>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                                
                                <div class="flex items-center gap-2 flex-wrap mb-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                            {{ $announcement['category'] }}
                        </span>
                                    @if($announcement['urgent'])
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                            Urgent
                                        </span>
                                    @endif
                                </div>
                                
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                            {{ $announcement['summary'] }}
                        </p>
                    </div>
                            
                            <!-- Footer -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                <div class="flex items-center text-xs text-gray-500">
                                    <svg class="w-3.5 h-3.5 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $announcement['date'] }}</span>
                                </div>
                                <span class="text-xs font-semibold text-gray-700 group-hover:text-gray-900">Read More →</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

            <!-- Pagination -->
            @if($announcements->hasPages())
                <div class="flex justify-center mt-6">
                    <div class="flex items-center gap-2">
                        @if($announcements->onFirstPage())
                            <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $announcements->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Previous</a>
                        @endif

                        @foreach($announcements->getUrlRange(1, $announcements->lastPage()) as $page => $url)
                            @if($page == $announcements->currentPage())
                                <span class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($announcements->hasMorePages())
                            <a href="{{ $announcements->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</a>
                        @else
                            <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No announcements found.</p>
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

