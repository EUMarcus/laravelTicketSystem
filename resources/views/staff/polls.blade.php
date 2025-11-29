@extends('layouts.app')

@section('title', 'Polls - Staff Dashboard')

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
                        <span class="font-medium">News & Events</span>
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
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Community Polls</h1>
                    <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                    <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Participate in community decisions and voice your opinion</p>
                </div>
            </div>

            <!-- Polls Grid -->
            @php
                $allPolls = [
                    ['id' => 1, 'question' => 'Preferred Day for Community Market', 'description' => 'Which day works best for a weekly community market? We want to choose a day that works for most residents.', 'deadline' => 'Dec 15, 2024', 'status' => 'open', 'votes' => 234, 'category' => 'Community'],
                    ['id' => 2, 'question' => 'Community Garden Location', 'description' => 'Where should we establish the new community garden? Help us decide the best location for everyone.', 'deadline' => 'Dec 20, 2024', 'status' => 'open', 'votes' => 156, 'category' => 'Infrastructure'],
                    ['id' => 3, 'question' => 'Festival Theme for New Year', 'description' => 'What theme should we use for the New Year festival? Your input will help shape our celebration.', 'deadline' => 'Nov 30, 2024', 'status' => 'closed', 'votes' => 312, 'category' => 'Events'],
                    ['id' => 4, 'question' => 'Garbage Collection Schedule', 'description' => 'Should we change the garbage collection schedule? Current schedule is Monday and Thursday.', 'deadline' => 'Dec 25, 2024', 'status' => 'open', 'votes' => 89, 'category' => 'Service'],
                    ['id' => 5, 'question' => 'Youth Sports Program Activities', 'description' => 'Which sports activities should we include in the youth program? Select your top preferences.', 'deadline' => 'Jan 5, 2025', 'status' => 'open', 'votes' => 167, 'category' => 'Sports'],
                    ['id' => 6, 'question' => 'Community Center Renovation Priorities', 'description' => 'What should be our priority for the community center renovation? Help us allocate resources wisely.', 'deadline' => 'Dec 10, 2024', 'status' => 'closed', 'votes' => 278, 'category' => 'Infrastructure'],
                    ['id' => 7, 'question' => 'Monthly Meeting Time Preference', 'description' => 'What time works best for monthly community meetings? We want to maximize attendance.', 'deadline' => 'Jan 10, 2025', 'status' => 'open', 'votes' => 145, 'category' => 'Community'],
                    ['id' => 8, 'question' => 'Health Program Topics', 'description' => 'Which health topics should we cover in upcoming seminars? Your input helps us plan better programs.', 'deadline' => 'Dec 18, 2024', 'status' => 'open', 'votes' => 203, 'category' => 'Health'],
                    ['id' => 9, 'question' => 'Street Lighting Improvements', 'description' => 'Which areas need street lighting improvements most urgently? Help us prioritize safety improvements.', 'deadline' => 'Nov 28, 2024', 'status' => 'closed', 'votes' => 189, 'category' => 'Infrastructure'],
                    ['id' => 10, 'question' => 'Community Library Hours', 'description' => 'What hours should the community library be open? We want to serve the most residents possible.', 'deadline' => 'Jan 15, 2025', 'status' => 'open', 'votes' => 112, 'category' => 'Education'],
                    ['id' => 11, 'question' => 'Recycling Program Implementation', 'description' => 'How should we implement the recycling program? Share your ideas and preferences.', 'deadline' => 'Dec 22, 2024', 'status' => 'open', 'votes' => 198, 'category' => 'Environment'],
                    ['id' => 12, 'question' => 'Senior Citizen Activities', 'description' => 'What activities would seniors like to see in the community center? Help us plan engaging programs.', 'deadline' => 'Dec 12, 2024', 'status' => 'closed', 'votes' => 156, 'category' => 'Health'],
                ];

                // Paginate
                $perPage = 6;
                $currentPage = request('page', 1);
                $total = count($allPolls);
                $offset = ($currentPage - 1) * $perPage;
                $polls = array_slice($allPolls, $offset, $perPage);
                
                // Create paginator
                $polls = new \Illuminate\Pagination\LengthAwarePaginator(
                    $polls,
                    $total,
                    $perPage,
                    $currentPage,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
            @endphp

            @if(count($polls) > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    @foreach($polls as $poll)
                        <a href="{{ route('polls.show', $poll['id']) }}" class="block group">
                            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm h-full flex flex-col hover:border-gray-300 hover:shadow-md">
                                <!-- Header -->
                                <div class="mb-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <h3 class="text-base font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">
                                            {{ $poll['question'] }}
                                        </h3>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                    
                                    <div class="flex items-center gap-2 flex-wrap mb-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                            {{ $poll['category'] }}
                                        </span>
                                        @if($poll['status'] === 'open')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-[#65B741]/10 text-[#65B741] border border-[#65B741]/20">
                                                Open
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                                Closed
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                                        {{ $poll['description'] }}
                                    </p>
                                </div>
                                
                                <!-- Footer -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                    <div class="flex items-center gap-3 text-xs text-gray-500">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ $poll['votes'] }} votes</span>
                                        </div>
                                        <span>•</span>
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>{{ $poll['deadline'] }}</span>
                                        </div>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-700 group-hover:text-gray-900">
                                        @if($poll['status'] === 'open')
                                            Vote Now →
                                        @else
                                            View Results →
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($polls->hasPages())
                    <div class="flex justify-center mt-6">
                        <div class="flex items-center gap-2">
                            @if($polls->onFirstPage())
                                <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $polls->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Previous</a>
                            @endif

                            @foreach($polls->getUrlRange(1, $polls->lastPage()) as $page => $url)
                                @if($page == $polls->currentPage())
                                    <span class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if($polls->hasMorePages())
                                <a href="{{ $polls->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</a>
                            @else
                                <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No polls found.</p>
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

