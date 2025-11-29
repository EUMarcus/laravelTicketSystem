@extends('layouts.app')

@section('title', $ticket->subject . ' - Community Hub')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Back Button -->
    <div class="mb-6" data-aos="fade-down">
        <a href="{{ route('tickets.index') }}" class="inline-flex items-center space-x-2 text-text-secondary hover:text-primary transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Tickets</span>
        </a>
    </div>

    <!-- Ticket Header -->
    <div class="modern-card p-6 lg:p-8 mb-6 border-l-4 
        @if($ticket->status === 'open') border-primary 
        @elseif($ticket->status === 'in_progress') border-warning 
        @elseif($ticket->status === 'resolved') border-success 
        @else border-gray-400 @endif"
        data-aos="fade-up">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
            <div class="flex-1">
                <h1 class="text-2xl md:text-3xl font-bold text-text-primary mb-3">{{ $ticket->subject }}</h1>
                <div class="flex items-center gap-3 flex-wrap">
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
                    <span class="text-sm text-text-muted">#{{ substr($ticket->id, 0, 8) }}</span>
                    <span class="text-sm text-text-muted">•</span>
                    <span class="text-sm text-text-muted">{{ $ticket->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            
            @if($profile->isEmployee())
            <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" class="flex-shrink-0">
                    @csrf
                    @method('PATCH')
                <select name="status" onchange="this.form.submit()" class="modern-input text-sm py-2 cursor-pointer">
                        <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </form>
            @endif
        </div>

        @if($ticket->description)
        <div class="mt-4 p-4 bg-bg-cream rounded-lg border border-gray-100">
            <p class="text-text-primary leading-relaxed whitespace-pre-wrap">{{ $ticket->description }}</p>
        </div>
        @endif

        @if($ticket->attachments->where('message_id', null)->count() > 0)
        <div class="mt-4">
            <p class="text-sm font-semibold text-text-primary mb-3">Initial Attachments:</p>
            <div class="flex flex-wrap gap-2">
                @foreach($ticket->attachments->where('message_id', null) as $attachment)
                <a href="{{ $attachment->file_url }}" target="_blank" class="inline-flex items-center space-x-2 px-4 py-2 bg-primary-lighter hover:bg-primary-light rounded-lg transition-all duration-200 group">
                    @if($attachment->isImage())
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    @else
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    @endif
                    <span class="text-sm font-medium text-primary group-hover:underline">{{ $attachment->file_name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Messages/Chat -->
    <div class="modern-card p-6 lg:p-8 mb-6" data-aos="fade-up" data-aos-delay="100">
        <h2 class="text-xl font-bold text-text-primary mb-6">Conversation</h2>
        
        <div class="space-y-6 max-h-[500px] overflow-y-auto mb-6 pr-2 scrollbar-thin scrollbar-thumb-primary-lighter scrollbar-track-transparent">
            @forelse($ticket->messages as $message)
            <div class="flex {{ $message->sender_id === $profile->id ? 'justify-end' : 'justify-start' }}" data-aos="fade-up">
                <div class="max-w-[75%] sm:max-w-[65%]">
                    <div class="flex items-center space-x-2 mb-2 {{ $message->sender_id === $profile->id ? 'justify-end' : 'justify-start' }}">
                        <span class="text-sm font-semibold text-text-primary">{{ $message->sender->name }}</span>
                        <span class="text-xs text-text-muted">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="rounded-2xl p-4 {{ $message->sender_id === $profile->id ? 'bg-primary text-white rounded-tr-sm' : 'bg-gray-100 text-text-primary rounded-tl-sm' }}">
                    @if($message->content)
                        <p class="mb-2 whitespace-pre-wrap leading-relaxed">{{ $message->content }}</p>
                    @endif
                    
                    @if($message->attachments->count() > 0)
                        <div class="mt-3 space-y-2 pt-3 border-t {{ $message->sender_id === $profile->id ? 'border-white/20' : 'border-gray-200' }}">
                        @foreach($message->attachments as $attachment)
                            <div class="{{ $message->sender_id === $profile->id ? 'bg-white/10' : 'bg-white' }} rounded-lg p-2">
                            @if($attachment->isImage())
                            <a href="{{ $attachment->file_url }}" target="_blank" class="block">
                                    <img src="{{ $attachment->file_url }}" alt="{{ $attachment->file_name }}" class="max-w-xs rounded-lg hover:opacity-90 transition-opacity">
                            </a>
                            @else
                                <a href="{{ $attachment->file_url }}" target="_blank" class="flex items-center space-x-2 {{ $message->sender_id === $profile->id ? 'text-white hover:text-white/80' : 'text-primary hover:text-primary-dark' }} transition-colors">
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
            </div>
            @empty
            <div class="text-center py-12" data-aos="fade-up">
                <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                    <svg class="w-12 h-12 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <p class="text-text-secondary">No messages yet. Start the conversation!</p>
            </div>
            @endforelse
        </div>

        <!-- Message Form -->
        <form method="POST" action="{{ route('tickets.messages.store', $ticket->id) }}" enctype="multipart/form-data" class="border-t border-gray-200 pt-6">
            @csrf
            
            <div class="mb-4">
                <textarea 
                    name="content" 
                    rows="3"
                    class="modern-input resize-none"
                    placeholder="Type your message..."
                ></textarea>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <label class="flex items-center space-x-2 cursor-pointer group">
                    <input type="file" name="attachments[]" multiple class="hidden" id="message-attachments" accept="image/*,application/pdf,.doc,.docx" onchange="updateAttachmentLabel(this)">
                    <span class="flex items-center space-x-2 px-4 py-2 border-2 border-gray-300 rounded-lg text-sm text-text-secondary hover:border-primary hover:text-primary hover:bg-primary-lighter transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <span id="attachment-label">Attach Files</span>
                    </span>
                </label>
                <button 
                    type="submit" 
                    class="btn-primary px-8 py-2 rounded-lg font-semibold w-full sm:w-auto"
                >
                    Send Message
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function updateAttachmentLabel(input) {
    const label = document.getElementById('attachment-label');
    if (input.files.length > 0) {
        label.textContent = `${input.files.length} file(s) selected`;
    } else {
        label.textContent = 'Attach Files';
    }
}
</script>
@endsection
