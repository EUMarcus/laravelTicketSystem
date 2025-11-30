@extends('layouts.app')

@section('title', 'Reports - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                    {{ $profile->isEmployee() ? 'All Reports' : 'My Reports' }}
                </h1>
                <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Track and manage community reports</p>
            </div>
            @if($profile->isCustomer())
                <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>New Report</span>
                </a>
            @endif
        </div>
    </div>

    @if($tickets->count() > 0)
            <!-- Reports Grid -->
            <div class="grid md:grid-cols-2 gap-4 mb-6">
        @foreach($tickets as $ticket)
        <a href="{{ route('reports.show', $ticket->id) }}" class="block group">
            <div class="bg-white p-5 rounded-lg border border-gray-200 h-full flex flex-col hover:border-gray-300 hover:shadow-md transition-all">
                        <!-- Header -->
                        <div class="mb-4">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-base font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">
                            {{ $ticket->subject }}
                                </h3>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
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
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-4 text-gray-500">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                <span class="font-medium">{{ $ticket->created_at->diffForHumans() }}</span>
                                    </span>
                            @if($profile->isEmployee() && $ticket->customer)
                            <span>•</span>
                            <span class="font-medium">{{ $ticket->customer->name }}</span>
                            @endif
                        </div>
                        <span class="text-gray-400 font-mono text-xs">#{{ substr($ticket->id, 0, 8) }}</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
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
    @else
    <!-- Empty State -->
    <div class="text-center py-20">
        <div class="inline-block p-6 bg-[#65B741]/10 rounded-full mb-6">
            <svg class="w-20 h-20 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">No reports yet</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">Get started by creating your first report and we'll help you right away.</p>
        @if($profile->isCustomer())
        <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Create Your First Report</span>
        </a>
        @endif
    </div>
    @endif
</div>

@endsection
