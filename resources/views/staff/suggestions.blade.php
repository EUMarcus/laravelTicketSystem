@extends('layouts.app')

@section('title', 'Suggestions - Staff Dashboard')

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
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                    <div>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Community Suggestions</h1>
                        <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                        <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Share your ideas to improve our community</p>
                    </div>
                    <a href="{{ route('suggestions.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>New Suggestion</span>
                    </a>
                </div>
            </div>

            <!-- Sort Options -->
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm mb-6">
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Sort by:</span>
                    <a href="{{ route('staff.suggestions', ['sort' => 'newest', 'page' => 1]) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('sort', 'newest') == 'newest' ? 'bg-gray-900 text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400' }}">
                        Newest
                    </a>
                    <a href="{{ route('staff.suggestions', ['sort' => 'liked', 'page' => 1]) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('sort') == 'liked' ? 'bg-gray-900 text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400' }}">
                        Most Liked
                    </a>
                    <a href="{{ route('staff.suggestions', ['sort' => 'discussed', 'page' => 1]) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('sort') == 'discussed' ? 'bg-gray-900 text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400' }}">
                        Most Discussed
                    </a>
                </div>
            </div>

            <!-- Section Separator -->
            <div class="mb-8 pt-6 border-t border-gray-200">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Public Suggestions</h2>
                <p class="text-sm text-gray-600">Browse all community suggestions and ideas</p>
            </div>

            <!-- Suggestions Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                @php
                    // Generate a larger dataset for pagination
                    $allSuggestions = [
                        ['id' => 1, 'title' => 'Weekly Community Exercise Program', 'category' => 'Health', 'upvotes' => 45, 'comments' => 12, 'author' => 'Maria Santos', 'date' => '3 days ago', 'created_at' => '2024-12-10'],
                        ['id' => 2, 'title' => 'Install Solar-Powered Streetlights', 'category' => 'Infrastructure', 'upvotes' => 89, 'comments' => 23, 'author' => 'Anonymous', 'date' => '1 week ago', 'created_at' => '2024-12-03'],
                        ['id' => 3, 'title' => 'Monthly Barangay Festival', 'category' => 'Events', 'upvotes' => 156, 'comments' => 34, 'author' => 'Juan Dela Cruz', 'date' => '2 weeks ago', 'created_at' => '2024-11-26'],
                        ['id' => 4, 'title' => 'Free Computer Literacy Classes', 'category' => 'Education', 'upvotes' => 67, 'comments' => 15, 'author' => 'Ana Reyes', 'date' => '1 week ago', 'created_at' => '2024-12-03'],
                        ['id' => 5, 'title' => 'Community Garden Project', 'category' => 'Environment', 'upvotes' => 112, 'comments' => 28, 'author' => 'Pedro Martinez', 'date' => '5 days ago', 'created_at' => '2024-12-08'],
                        ['id' => 6, 'title' => 'Youth Sports Tournament', 'category' => 'Sports', 'upvotes' => 78, 'comments' => 19, 'author' => 'Anonymous', 'date' => '4 days ago', 'created_at' => '2024-12-09'],
                        ['id' => 7, 'title' => 'Community Library Expansion', 'category' => 'Education', 'upvotes' => 92, 'comments' => 21, 'author' => 'Liza Garcia', 'date' => '6 days ago', 'created_at' => '2024-12-07'],
                        ['id' => 8, 'title' => 'Recycling Program', 'category' => 'Environment', 'upvotes' => 134, 'comments' => 31, 'author' => 'Carlos Rivera', 'date' => '1 week ago', 'created_at' => '2024-12-03'],
                        ['id' => 9, 'title' => 'Senior Citizen Wellness Program', 'category' => 'Health', 'upvotes' => 56, 'comments' => 14, 'author' => 'Rosa Fernandez', 'date' => '2 days ago', 'created_at' => '2024-12-11'],
                        ['id' => 10, 'title' => 'Bike Lane Installation', 'category' => 'Infrastructure', 'upvotes' => 103, 'comments' => 26, 'author' => 'Miguel Torres', 'date' => '3 days ago', 'created_at' => '2024-12-10'],
                        ['id' => 11, 'title' => 'Community Market Day', 'category' => 'Events', 'upvotes' => 87, 'comments' => 18, 'author' => 'Carmen Lopez', 'date' => '4 days ago', 'created_at' => '2024-12-09'],
                        ['id' => 12, 'title' => 'Neighborhood Watch Program', 'category' => 'Safety', 'upvotes' => 145, 'comments' => 37, 'author' => 'Roberto Cruz', 'date' => '5 days ago', 'created_at' => '2024-12-08'],
                    ];

                    // Apply sorting
                    $sortBy = request('sort', 'newest');
                    $sortedSuggestions = $allSuggestions;
                    
                    if ($sortBy === 'liked') {
                        usort($sortedSuggestions, function($a, $b) {
                            return $b['upvotes'] - $a['upvotes'];
                        });
                    } elseif ($sortBy === 'discussed') {
                        usort($sortedSuggestions, function($a, $b) {
                            return $b['comments'] - $a['comments'];
                        });
                    } else {
                        // Newest (default) - already sorted by date
                        usort($sortedSuggestions, function($a, $b) {
                            return strtotime($b['created_at']) - strtotime($a['created_at']);
                        });
                    }
                    
                    // Paginate
                    $perPage = 6;
                    $currentPage = (int)request('page', 1);
                    $total = count($sortedSuggestions);
                    $offset = ($currentPage - 1) * $perPage;
                    $paginatedSuggestions = array_slice($sortedSuggestions, $offset, $perPage);
                    
                    // Create paginator
                    $suggestions = new \Illuminate\Pagination\LengthAwarePaginator(
                        $paginatedSuggestions,
                        $total,
                        $perPage,
                        $currentPage,
                        ['path' => request()->url(), 'query' => request()->query()]
                    );
                @endphp

                @if(count($suggestions) > 0)
                @foreach($suggestions as $suggestion)
                <a href="{{ route('suggestions.show', $suggestion['id']) }}" class="block group">
                    <div class="bg-white p-5 rounded-lg border border-gray-200 h-full flex flex-col hover:border-gray-300 hover:shadow-md">
                        <!-- Header -->
                        <div class="mb-4">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-base font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">
                                    {{ $suggestion['title'] }}
                                </h3>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            
                            <div class="flex items-center gap-2 flex-wrap mb-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                    {{ $suggestion['category'] }}
                                </span>
                            </div>
                            
                            <div class="flex items-center text-xs text-gray-500 mb-4">
                                <span>By {{ $suggestion['author'] }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $suggestion['date'] }}</span>
                            </div>
                        </div>
                        
                        <!-- Footer Info -->
                        <div class="pt-4 border-t border-gray-100 mt-auto">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4 text-sm">
                                    <div class="flex items-center gap-1.5 text-gray-600">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        <span class="font-semibold text-gray-900">{{ $suggestion['upvotes'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-gray-600">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <span class="font-semibold text-gray-900">{{ $suggestion['comments'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">No suggestions found.</p>
                </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($suggestions->hasPages())
            <div class="flex justify-center mt-6">
                <div class="flex items-center gap-2">
                    @if($suggestions->onFirstPage())
                        <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $suggestions->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Previous</a>
                    @endif

                    @foreach($suggestions->getUrlRange(1, $suggestions->lastPage()) as $page => $url)
                        @if($page == $suggestions->currentPage())
                            <span class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($suggestions->hasMorePages())
                        <a href="{{ $suggestions->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</a>
                    @else
                        <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                    @endif
                </div>
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

