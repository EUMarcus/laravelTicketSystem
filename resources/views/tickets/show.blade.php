@extends('layouts.app')

@section('title', $ticket->subject . ' - Kampay Tickets')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Ticket Header -->
    <div class="card p-6 mb-6 border-l-4 animate-fade-in
        @if($ticket->status === 'open') border-[#007E6E] 
        @elseif($ticket->status === 'in_progress') border-[#E7DEAF] 
        @elseif($ticket->status === 'resolved') border-[#73AF6F] 
        @else border-gray-400 @endif">
        <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-4">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-[#2d3748] mb-3">{{ $ticket->subject }}</h1>
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="badge badge-status-{{ str_replace('_', '-', $ticket->status) }}">
                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                    <span class="badge badge-priority-{{ $ticket->priority }}">
                        {{ ucfirst($ticket->priority) }}
                    </span>
                    <span class="text-sm text-[#718096] flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        #{{ substr($ticket->id, 0, 8) }}
                    </span>
                    <span class="text-sm text-[#718096]">•</span>
                    <span class="text-sm text-[#718096]">{{ $ticket->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            
            @if($profile->isEmployee())
            <div>
                <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" class="inline">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()" class="input-modern text-sm py-2">
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
        <div class="mt-4 p-4 bg-[#f5f3ed] rounded-modern border border-[#e2e8f0]">
            <p class="text-[#2d3748] leading-relaxed">{{ $ticket->description }}</p>
        </div>
        @endif

        @if($ticket->attachments->where('message_id', null)->count() > 0)
        <div class="mt-4">
            <p class="text-sm font-semibold text-[#2d3748] mb-3">Initial Attachments:</p>
            <div class="flex flex-wrap gap-2">
                @foreach($ticket->attachments->where('message_id', null) as $attachment)
                <a href="{{ $attachment->file_url }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-[#007E6E]/10 hover:bg-[#007E6E]/20 rounded-modern border border-[#007E6E]/20 transition group">
                    @if($attachment->isImage())
                    <svg class="w-5 h-5 text-[#007E6E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    @else
                    <svg class="w-5 h-5 text-[#007E6E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    @endif
                    <span class="text-sm font-medium text-[#2d3748] group-hover:text-[#007E6E] transition">{{ $attachment->file_name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Messages/Chat -->
    <div class="card p-6 mb-6 animate-fade-in" style="animation-delay: 0.1s">
        <h2 class="text-xl font-bold text-[#2d3748] mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-[#007E6E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            Conversation
        </h2>
        
        <div class="space-y-4 max-h-96 overflow-y-auto mb-6 pr-2">
            @forelse($ticket->messages as $message)
            <div class="flex {{ $message->sender_id === $profile->id ? 'justify-end' : 'justify-start' }} animate-slide-in">
                <div class="max-w-2xl {{ $message->sender_id === $profile->id ? 'bg-gradient-to-r from-[#007E6E] to-[#00a693] text-white' : 'bg-[#f5f3ed] text-[#2d3748] border border-[#e2e8f0]' }} rounded-modern-lg p-4 shadow-soft">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="font-semibold text-sm">{{ $message->sender->name }}</span>
                        <span class="text-xs opacity-75">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                    @if($message->content)
                    <p class="mb-2 leading-relaxed">{{ $message->content }}</p>
                    @endif
                    
                    @if($message->attachments->count() > 0)
                    <div class="mt-3 space-y-2">
                        @foreach($message->attachments as $attachment)
                        <div class="{{ $message->sender_id === $profile->id ? 'bg-white/20' : 'bg-white' }} rounded-modern p-2">
                            @if($attachment->isImage())
                            <a href="{{ $attachment->file_url }}" target="_blank" class="block">
                                <img src="{{ $attachment->file_url }}" alt="{{ $attachment->file_name }}" class="max-w-xs rounded-modern shadow-soft">
                            </a>
                            @else
                            <a href="{{ $attachment->file_url }}" target="_blank" class="flex items-center gap-2 {{ $message->sender_id === $profile->id ? 'text-white' : 'text-[#007E6E]' }} hover:opacity-80 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm font-medium">{{ $attachment->file_name }}</span>
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-[#a0aec0] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <p class="text-[#718096]">No messages yet. Start the conversation!</p>
            </div>
            @endforelse
        </div>

        <!-- Message Form -->
        <form method="POST" action="{{ route('tickets.messages.store', $ticket->id) }}" enctype="multipart/form-data" class="border-t border-[#e2e8f0] pt-4">
            @csrf
            
            <div class="mb-4">
                <textarea 
                    name="content" 
                    rows="3"
                    class="input-modern resize-none"
                    placeholder="Type your message..."
                ></textarea>
            </div>

            <div class="flex items-center justify-between gap-4">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="file" name="attachments[]" multiple class="hidden" id="message-attachments" accept="image/*,application/pdf,.doc,.docx">
                    <span class="px-4 py-2 border border-[#e2e8f0] rounded-modern text-sm text-[#4a5568] hover:bg-[#f5f3ed] transition font-medium flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                        Attach Files
                    </span>
                </label>
                <button 
                    type="submit" 
                    class="btn-primary px-6 py-2 flex items-center gap-2"
                >
                    <span>Send</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <div class="mb-6">
        <a href="{{ route('tickets.index') }}" class="text-[#007E6E] hover:text-[#005a4f] transition font-medium flex items-center gap-2 inline-flex">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Tickets
        </a>
    </div>
</div>
@endsection
