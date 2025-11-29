@extends('layouts.app')

@section('title', 'My Tickets - Community Hub')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4" data-aos="fade-down">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">
                {{ $profile->isEmployee() ? 'All Tickets' : 'My Tickets' }}
            </h1>
            <p class="text-text-secondary">Manage and track your support tickets</p>
        </div>
        @if($profile->isCustomer())
        <a 
            href="{{ route('tickets.create') }}" 
            class="btn-primary px-6 py-3 rounded-lg flex items-center space-x-2 group"
            data-aos="fade-left"
        >
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>New Ticket</span>
        </a>
        @endif
    </div>

    @if($tickets->count() > 0)
    <!-- Tickets Grid -->
    <div class="grid gap-4 lg:gap-6" data-aos="fade-up">
        @foreach($tickets as $ticket)
        <a href="{{ route('tickets.show', $ticket->id) }}" class="block group">
            <div class="modern-card p-6 hover-lift border-l-4 
                @if($ticket->status === 'open') border-primary 
                @elseif($ticket->status === 'in_progress') border-warning 
                @elseif($ticket->status === 'resolved') border-success 
                @else border-gray-400 @endif"
                data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-3 flex-wrap">
                            <h3 class="text-xl font-semibold text-text-primary group-hover:text-primary transition-colors">
                                {{ $ticket->subject }}
                            </h3>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($ticket->status === 'open') bg-primary-lighter text-primary
                                    @elseif($ticket->status === 'in_progress') bg-warning-light text-warning
                                    @elseif($ticket->status === 'resolved') bg-success-light text-success
                                    @else bg-gray-100 text-gray-600 @endif">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($ticket->priority === 'urgent') bg-error-light text-error
                                    @elseif($ticket->priority === 'high') bg-warning-light text-warning
                                    @elseif($ticket->priority === 'medium') bg-info-light text-info
                                    @else bg-gray-100 text-gray-600 @endif">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                            </div>
                        </div>
                        
                        @if($ticket->description)
                        <p class="text-text-secondary mb-4 line-clamp-2 leading-relaxed">
                            {{ $ticket->description }}
                        </p>
                        @endif

                        <div class="flex items-center gap-4 text-sm text-text-muted flex-wrap">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                #{{ substr($ticket->id, 0, 8) }}
                            </span>
                            <span>•</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $ticket->created_at->diffForHumans() }}
                            </span>
                            @if($profile->isEmployee() && $ticket->customer)
                            <span>•</span>
                            <span>{{ $ticket->customer->name }}</span>
                            @endif
                            @if($ticket->assignedEmployee)
                            <span>•</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ $ticket->assignedEmployee->name }}
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-text-muted group-hover:text-primary group-hover:translate-x-1 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8" data-aos="fade-up">
        {{ $tickets->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-20" data-aos="fade-up">
        <div class="inline-block p-6 bg-primary-lighter rounded-full mb-6">
            <svg class="w-20 h-20 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-text-primary mb-2">No tickets yet</h3>
        <p class="text-text-secondary mb-8 max-w-md mx-auto">Get started by creating your first support ticket and we'll help you right away.</p>
        @if($profile->isCustomer())
        <a 
            href="{{ route('tickets.create') }}" 
            class="btn-primary px-8 py-3 rounded-lg inline-flex items-center space-x-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Create Your First Ticket</span>
        </a>
        @endif
    </div>
    @endif
</div>
@endsection
