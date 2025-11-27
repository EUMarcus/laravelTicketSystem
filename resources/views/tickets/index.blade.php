@extends('layouts.app')

@section('title', 'My Tickets - Kampay Tickets')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-kampay-text-warm dark:text-white">
                {{ $profile->isEmployee() ? 'All Tickets' : 'My Tickets' }}
            </h1>
            <p class="text-kampay-text-muted mt-2">Manage and track your support tickets</p>
        </div>
        @if($profile->isCustomer())
        <a 
            href="{{ route('tickets.create') }}" 
            class="bg-gradient-to-r from-kampay-teal to-kampay-teal-dark hover:from-kampay-teal-dark hover:to-kampay-teal text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 transform hover:scale-105 flex items-center space-x-2"
        >
            <span>+</span>
            <span>New Ticket</span>
        </a>
        @endif
    </div>

    @if($tickets->count() > 0)
    <div class="grid gap-4">
        @foreach($tickets as $ticket)
        <a href="{{ route('tickets.show', $ticket->id) }}" class="block">
            <div class="bg-white dark:bg-kampay-bg-darker rounded-xl shadow-md hover:shadow-xl p-6 transition-all duration-200 border-l-4 @if($ticket->status === 'open') border-kampay-teal @elseif($ticket->status === 'in_progress') border-kampay-yellow-orange @elseif($ticket->status === 'resolved') border-kampay-blue @else border-gray-500 @endif">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2 flex-wrap">
                            <h3 class="text-xl font-semibold text-kampay-text-warm dark:text-white">
                                {{ $ticket->subject }}
                            </h3>
                            <span class="px-3 py-1 rounded-full text-xs font-medium @if($ticket->status === 'open') bg-kampay-teal-light text-kampay-teal-dark @elseif($ticket->status === 'in_progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 @elseif($ticket->status === 'resolved') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 @endif">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-medium @if($ticket->priority === 'urgent') bg-kampay-red-light text-kampay-red-dark @elseif($ticket->priority === 'high') bg-yellow-100 text-yellow-800 @elseif($ticket->priority === 'medium') bg-blue-100 text-blue-800 @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </div>
                        
                        @if($ticket->description)
                        <p class="text-kampay-text-muted mb-3 line-clamp-2">
                            {{ $ticket->description }}
                        </p>
                        @endif

                        <div class="flex items-center space-x-4 text-sm text-kampay-text-muted">
                            <span>#{{ substr($ticket->id, 0, 8) }}</span>
                            <span>•</span>
                            <span>{{ $ticket->created_at->diffForHumans() }}</span>
                            @if($profile->isEmployee() && $ticket->customer)
                            <span>•</span>
                            <span>Customer: {{ $ticket->customer->name }}</span>
                            @endif
                            @if($ticket->assignedEmployee)
                            <span>•</span>
                            <span>Assigned to: {{ $ticket->assignedEmployee->name }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="ml-4">
                        <svg class="w-6 h-6 text-kampay-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    <div class="text-center py-16">
        <div class="inline-block p-4 bg-kampay-teal-light rounded-full mb-4">
            <svg class="w-16 h-16 text-kampay-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-kampay-text-warm dark:text-white mb-2">No tickets yet</h3>
        <p class="text-kampay-text-muted mb-6">Get started by creating your first support ticket</p>
        @if($profile->isCustomer())
        <a 
            href="{{ route('tickets.create') }}" 
            class="inline-block bg-gradient-to-r from-kampay-teal to-kampay-teal-dark hover:from-kampay-teal-dark hover:to-kampay-teal text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 transform hover:scale-105"
        >
            Create Your First Ticket
        </a>
        @endif
    </div>
    @endif
</div>
@endsection


