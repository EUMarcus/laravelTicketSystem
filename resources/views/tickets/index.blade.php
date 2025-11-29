@extends('layouts.app')

@section('title', 'My Tickets - Kampay Tickets')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#2d3748] mb-2">
                {{ $profile->isEmployee() ? 'All Tickets' : 'My Tickets' }}
            </h1>
            <p class="text-[#718096]">Manage and track your support tickets</p>
        </div>
        @if($profile->isCustomer())
        <a 
            href="{{ route('tickets.create') }}" 
            class="btn-primary flex items-center space-x-2 whitespace-nowrap"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>New Ticket</span>
        </a>
        @endif
    </div>

    @if($tickets->count() > 0)
    <div class="grid gap-4">
        @foreach($tickets as $ticket)
        <a href="{{ route('tickets.show', $ticket->id) }}" class="block group">
            <div class="card p-6 hover:shadow-medium transition-all border-l-4 
                @if($ticket->status === 'open') border-[#007E6E] 
                @elseif($ticket->status === 'in_progress') border-[#E7DEAF] 
                @elseif($ticket->status === 'resolved') border-[#73AF6F] 
                @else border-gray-400 @endif">
                <div class="flex justify-between items-start gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-3 flex-wrap">
                            <h3 class="text-lg font-semibold text-[#2d3748] group-hover:text-[#007E6E] transition truncate">
                                {{ $ticket->subject }}
                            </h3>
                            <span class="badge badge-status-{{ str_replace('_', '-', $ticket->status) }}">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                            <span class="badge badge-priority-{{ $ticket->priority }}">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </div>
                        
                        @if($ticket->description)
                        <p class="text-[#718096] mb-4 line-clamp-2 text-sm leading-relaxed">
                            {{ $ticket->description }}
                        </p>
                        @endif

                        <div class="flex items-center flex-wrap gap-3 text-sm text-[#718096]">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                #{{ substr($ticket->id, 0, 8) }}
                            </span>
                            <span>•</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $ticket->created_at->diffForHumans() }}
                            </span>
                            @if($profile->isEmployee() && $ticket->customer)
                            <span>•</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $ticket->customer->name }}
                            </span>
                            @endif
                            @if($ticket->assignedEmployee)
                            <span>•</span>
                            <span class="text-[#007E6E] font-medium">{{ $ticket->assignedEmployee->name }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-[#718096] group-hover:text-[#007E6E] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $tickets->links() }}
    </div>
    @else
    <div class="text-center py-20">
        <div class="inline-block p-6 bg-[#007E6E]/10 rounded-2xl mb-6">
            <svg class="w-20 h-20 text-[#007E6E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-[#2d3748] mb-3">No tickets yet</h3>
        <p class="text-[#718096] mb-8 max-w-md mx-auto">Get started by creating your first support ticket. We're here to help!</p>
        @if($profile->isCustomer())
        <a 
            href="{{ route('tickets.create') }}" 
            class="btn-primary inline-flex items-center space-x-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Create Your First Ticket</span>
        </a>
        @endif
    </div>
    @endif
</div>
@endsection


