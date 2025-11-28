@extends('layouts.app')

@section('title', $ticket->subject . ' - Kampay Tickets')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Ticket Header -->
    <div class="bg-white dark:bg-kampay-bg-darker rounded-xl shadow-md p-6 mb-6 border-l-4 @if($ticket->status === 'open') border-kampay-teal @elseif($ticket->status === 'in_progress') border-kampay-yellow-orange @elseif($ticket->status === 'resolved') border-kampay-blue @else border-gray-500 @endif">
        <div class="flex justify-between items-start mb-4">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-kampay-text-warm dark:text-white mb-2">{{ $ticket->subject }}</h1>
                <div class="flex items-center space-x-3 flex-wrap">
                    <span class="px-3 py-1 rounded-full text-xs font-medium @if($ticket->status === 'open') bg-kampay-teal-light text-kampay-teal-dark @elseif($ticket->status === 'in_progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 @elseif($ticket->status === 'resolved') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 @endif">
                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-medium @if($ticket->priority === 'urgent') bg-kampay-red-light text-kampay-red-dark @elseif($ticket->priority === 'high') bg-yellow-100 text-yellow-800 @elseif($ticket->priority === 'medium') bg-blue-100 text-blue-800 @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($ticket->priority) }}
                    </span>
                    <span class="text-sm text-kampay-text-muted">#{{ substr($ticket->id, 0, 8) }}</span>
                    <span class="text-sm text-kampay-text-muted">•</span>
                    <span class="text-sm text-kampay-text-muted">{{ $ticket->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            
            @if($profile->isEmployee())
            <div class="ml-4">
                <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" class="inline">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-gray-300 dark:border-kampay-bg-dark dark:bg-kampay-bg-dark dark:text-white text-sm">
                        <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </form>
            </div>
            @endif
        </div>

        @if($ticket->description)
        <div class="mt-4 p-4 bg-kampay-bg-cream dark:bg-kampay-bg-dark rounded-lg">
            <p class="text-kampay-text-warm dark:text-white">{{ $ticket->description }}</p>
        </div>
        @endif

        @if($ticket->attachments->where('message_id', null)->count() > 0)
        <div class="mt-4">
            <p class="text-sm font-medium text-kampay-text-warm dark:text-white mb-2">Initial Attachments:</p>
            <div class="flex flex-wrap gap-2">
                @foreach($ticket->attachments->where('message_id', null) as $attachment)
                <a href="{{ $attachment->file_url }}" target="_blank" class="flex items-center space-x-2 px-3 py-2 bg-kampay-teal-light rounded-lg hover:bg-kampay-teal transition">
                    @if($attachment->isImage())
                    <svg class="w-5 h-5 text-kampay-teal-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    @else
                    <svg class="w-5 h-5 text-kampay-teal-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    @endif
                    <span class="text-sm text-kampay-teal-dark">{{ $attachment->file_name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Messages/Chat -->
    <div class="bg-white dark:bg-kampay-bg-darker rounded-xl shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-kampay-text-warm dark:text-white mb-4">Conversation</h2>
        
        <div class="space-y-4 max-h-96 overflow-y-auto mb-6">
            @forelse($ticket->messages as $message)
            <div class="flex {{ $message->sender_id === $profile->id ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-2xl {{ $message->sender_id === $profile->id ? 'bg-kampay-teal text-white' : 'bg-gray-100 dark:bg-kampay-bg-dark text-kampay-text-warm dark:text-white' }} rounded-lg p-4">
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="font-semibold">{{ $message->sender->name }}</span>
                        <span class="text-xs opacity-75">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                    @if($message->content)
                    <p class="mb-2">{{ $message->content }}</p>
                    @endif
                    
                    @if($message->attachments->count() > 0)
                    <div class="mt-2 space-y-2">
                        @foreach($message->attachments as $attachment)
                        <div class="bg-white dark:bg-kampay-bg-darker rounded p-2">
                            @if($attachment->isImage())
                            <a href="{{ $attachment->file_url }}" target="_blank" class="block">
                                <img src="{{ $attachment->file_url }}" alt="{{ $attachment->file_name }}" class="max-w-xs rounded">
                            </a>
                            @else
                            <a href="{{ $attachment->file_url }}" target="_blank" class="flex items-center space-x-2 text-kampay-teal hover:text-kampay-teal-dark">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm">{{ $attachment->file_name }}</span>
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-center text-kampay-text-muted py-8">No messages yet. Start the conversation!</p>
            @endforelse
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-kampay-red-light border border-kampay-red rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-kampay-red" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-kampay-red-dark">Upload Error</h3>
                        <div class="mt-2 text-sm text-kampay-red-dark">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Message Form -->
        <form method="POST" action="{{ route('tickets.messages.store', $ticket->id) }}" enctype="multipart/form-data" class="border-t border-gray-200 dark:border-kampay-bg-dark pt-4">
            @csrf
            
            <div class="mb-4">
                <textarea 
                    name="content" 
                    rows="3"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-kampay-bg-dark focus:ring-2 focus:ring-kampay-teal focus:border-transparent dark:bg-kampay-bg-dark dark:text-white"
                    placeholder="Type your message..."
                ></textarea>
            </div>

            <div class="mb-4">
                <div id="message-file-list" class="mb-2"></div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="file" name="attachments[]" multiple class="hidden" id="message-attachments" accept="image/*,application/pdf,.doc,.docx">
                    <span class="px-4 py-2 border border-gray-300 dark:border-kampay-bg-dark rounded-lg text-sm text-kampay-text-warm dark:text-white hover:bg-gray-50 dark:hover:bg-kampay-bg-dark transition">
                        📎 Attach Files
                    </span>
                </label>
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-gradient-to-r from-kampay-teal to-kampay-teal-dark hover:from-kampay-teal-dark hover:to-kampay-teal text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105"
                >
                    Send Message
                </button>
            </div>
        </form>
    </div>

    <div class="mb-4">
        <a href="{{ route('tickets.index') }}" class="text-kampay-teal hover:text-kampay-teal-dark">
            ← Back to Tickets
        </a>
    </div>
</div>

<script>
    // Handle file attachments display
    document.getElementById('message-attachments').addEventListener('change', function(e) {
        const fileList = document.getElementById('message-file-list');
        fileList.innerHTML = '';
        
        if (e.target.files.length > 0) {
            const container = document.createElement('div');
            container.className = 'flex flex-wrap gap-2';
            
            Array.from(e.target.files).forEach(file => {
                const badge = document.createElement('div');
                badge.className = 'inline-flex items-center space-x-2 px-3 py-1 bg-kampay-teal-light dark:bg-kampay-bg-dark rounded-lg text-sm';
                badge.innerHTML = `
                    <svg class="w-4 h-4 text-kampay-teal-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <span class="text-kampay-teal-dark dark:text-white">${file.name}</span>
                    <span class="text-xs text-kampay-text-muted">(${(file.size / 1024).toFixed(1)} KB)</span>
                `;
                container.appendChild(badge);
            });
            
            fileList.appendChild(container);
        }
    });
</script>
@endsection


