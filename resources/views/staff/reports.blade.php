@extends('layouts.app')

@section('title', 'Reports - Staff Dashboard')

@section('content')
@if((session('user') && in_array(session('user')['role'] ?? '', ['employee', 'admin'])) || (Auth::user() && Auth::user()->profile && Auth::user()->profile->isEmployee()))
<div class="flex min-h-screen" style="padding-top: 4rem;">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 fixed left-0 top-16 h-[calc(100vh-4rem)] overflow-y-auto z-40 shadow-sm" style="position: fixed !important; top: 4rem !important; left: 0 !important; z-index: 40 !important; background-color: #ffffff !important;">
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
                    
                </div>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 min-h-screen" style="margin-left: 16rem !important; margin-top: -4rem !important;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-0 pb-8">
            <!-- Header -->
            <div class="mb-10">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Reports & Tickets</h1>
                        <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                        <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Track and manage community issues</p>
                    </div>
                </div>
            </div>

            <!-- Reports List -->
            <div>
                    <!-- Reports Grid -->
                    <div id="reportsGrid" class="grid md:grid-cols-2 gap-4 mb-6">
                        @if($tickets->count() > 0)
                        @foreach($tickets as $ticket)
                        <div class="bg-white p-5 rounded-lg border border-gray-200 h-full flex flex-col hover:border-gray-300 hover:shadow-md transition-all">
                            <!-- Header -->
                            <div class="mb-4">
                                <div class="flex items-start justify-between mb-3">
                                    <a href="{{ route('reports.show', $ticket->id) }}" class="flex-1 group">
                                        <h3 class="text-base font-bold text-gray-900 line-clamp-2 group-hover:text-gray-700">
                                            {{ $ticket->subject }}
                                        </h3>
                                    </a>
                                </div>
                                
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                                        @if($ticket->status === 'open') bg-[#65B741]/10 text-[#65B741] border border-[#65B741]/20
                                        @elseif($ticket->status === 'in_progress') bg-[#FFB534]/10 text-[#FFB534] border border-[#FFB534]/20
                                        @elseif($ticket->status === 'resolved' || $ticket->status === 'closed') bg-gray-100 text-gray-700 border border-gray-200
                                        @else bg-gray-100 text-gray-600 border border-gray-200 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                                        @if($ticket->priority === 'urgent' || $ticket->priority === 'high') bg-red-50 text-red-700 border border-red-200
                                        @elseif($ticket->priority === 'medium') bg-yellow-50 text-yellow-700 border border-yellow-200
                                        @else bg-gray-50 text-gray-600 border border-gray-200 @endif">
                                        {{ ucfirst($ticket->priority) }} Priority
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Description -->
                            @if($ticket->description)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed flex-grow">
                                {{ $ticket->description }}
                            </p>
                            @endif

                            <!-- Footer Info -->
                            <div class="pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-between text-xs mb-3">
                                    <div class="flex items-center gap-4 text-gray-500">
                                        <span class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="font-medium">{{ $ticket->created_at->diffForHumans() }}</span>
                                        </span>
                                        @if($ticket->customer)
                                        <span>•</span>
                                        <span class="font-medium">{{ $ticket->customer->name }}</span>
                                        @endif
                                    </div>
                                    <span class="text-gray-400 font-mono text-xs">#{{ substr($ticket->id, 0, 8) }}</span>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('reports.show', $ticket->id) }}" class="flex-1 px-3 py-2 text-xs font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-center">
                                        Manage
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-span-2 text-center py-12">
                            <div class="inline-block p-6 bg-[#65B741]/10 rounded-full mb-6">
                                <svg class="w-20 h-20 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">No reports yet</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">There are no reports in the system at this time.</p>
                        </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if($tickets->hasPages())
                    <div class="flex justify-center mt-6">
                        <div class="flex items-center gap-2">
                            @if($tickets->onFirstPage())
                                <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $tickets->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Previous</a>
                            @endif

                            @foreach($tickets->getUrlRange(1, $tickets->lastPage()) as $page => $url)
                                @if($page == $tickets->currentPage())
                                    <span class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if($tickets->hasMorePages())
                                <a href="{{ $tickets->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</a>
                            @else
                                <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                            @endif
                        </div>
                    </div>
                    @endif
            </div>
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

