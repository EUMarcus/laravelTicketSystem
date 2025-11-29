@extends('layouts.app')

@section('title', $ticket->subject . ' - Community Hub')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('reports.index') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-[#65B741] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Reports</span>
        </a>
    </div>

    <!-- Report Header -->
    <div class="bg-white p-6 lg:p-8 mb-6 rounded-lg border border-gray-200 shadow-sm border-l-4 
        @if($ticket->status === 'open') border-[#65B741] 
        @elseif($ticket->status === 'in_progress') border-[#FFB534] 
        @elseif($ticket->status === 'resolved') border-gray-400 
        @else border-gray-400 @endif">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
            <div class="flex-1">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">{{ $ticket->subject }}</h1>
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($ticket->status === 'open') bg-[#65B741]/10 text-[#65B741]
                        @elseif($ticket->status === 'in_progress') bg-[#FFB534]/10 text-[#FFB534]
                        @elseif($ticket->status === 'resolved') bg-gray-100 text-gray-700
                        @else bg-gray-100 text-gray-600 @endif">
                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($ticket->priority === 'urgent') bg-red-50 text-red-700
                        @elseif($ticket->priority === 'high') bg-yellow-50 text-yellow-700
                        @elseif($ticket->priority === 'medium') bg-blue-50 text-blue-700
                        @else bg-gray-100 text-gray-600 @endif">
                        {{ ucfirst($ticket->priority) }}
                    </span>
                    <span class="text-sm text-gray-500">#{{ substr($ticket->id, 0, 8) }}</span>
                    <span class="text-sm text-gray-500">•</span>
                    <span class="text-sm text-gray-500">{{ $ticket->created_at->format('M d, Y') }}</span>
    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Report Details Card -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 lg:p-8 mb-6" id="reportDetailsCard">
                <!-- Loading state -->
                <div id="loadingState" class="text-center py-12">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-[#65B741]"></div>
                    <p class="mt-4 text-gray-600">Loading report...</p>
                </div>

                <!-- Report content (hidden initially) -->
                <div id="reportContent" class="hidden">
                    <!-- Header -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span id="reportCategory" class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200"></span>
                                <span id="reportStatus" class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium"></span>
                                <span id="reportPriority" class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium"></span>
                                <span id="reportTicketId" class="text-gray-400 font-mono text-xs"></span>
                            </div>
                            <!-- Public Toggle (only for report owner) -->
                            <div id="publicToggleContainer" class="hidden flex items-center gap-3">
                                <span class="text-sm text-gray-600 font-medium">Share Publicly</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="publicToggle" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#65B741] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#65B741]"></div>
                                </label>
                            </div>
                        </div>
                        <h1 id="reportTitle" class="text-3xl md:text-4xl font-bold text-gray-900 mb-2"></h1>
                        <p id="reportDate" class="text-gray-600"></p>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-3">Description</h2>
                        <p id="reportDescription" class="text-gray-700 leading-relaxed text-base"></p>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">Location</h3>
                            <div class="flex items-center gap-2 text-gray-900">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span id="reportLocation" class="font-medium"></span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">Reported By</h3>
                            <div class="flex items-center gap-2 text-gray-900">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span id="reportAuthor" class="font-medium"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Photos/Attachments Section -->
                    <div id="photoSection" class="border-t border-gray-200 pt-6 hidden">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Photos & Attachments</h2>
                        <div id="photosGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>
                    </div>
                </div>

                <!-- Not found state -->
                <div id="notFoundState" class="hidden text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Report Not Found</h3>
                    <p class="text-gray-600 mb-6">The report you're looking for doesn't exist or has been removed.</p>
                    <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                        <span>Back to Reports</span>
                    </a>
>>>>>>> 1aba87a0d1f507d0444bbc2b39e38f65ec486f9f
                </div>
            </div>
            
            @if($profile->isEmployee())
            <form method="POST" action="{{ route('reports.update', $ticket->id) }}" class="flex-shrink-0">
                @csrf
                @method('PATCH')
                <select name="status" onchange="this.form.submit()" class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white cursor-pointer">
                    <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </form>
            @endif
        </div>

        @if($ticket->description)
        <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-100">
            <p class="text-gray-900 leading-relaxed whitespace-pre-wrap">{{ $ticket->description }}</p>
        </div>
        @endif

        @if($ticket->attachments->where('message_id', null)->count() > 0)
        <div class="mt-4">
            <p class="text-sm font-semibold text-gray-900 mb-3">Initial Attachments:</p>
            <div class="flex flex-wrap gap-2">
                @foreach($ticket->attachments->where('message_id', null) as $attachment)
                <a href="{{ $attachment->file_url }}" target="_blank" class="inline-flex items-center space-x-2 px-4 py-2 bg-[#65B741]/10 hover:bg-[#65B741]/20 rounded-lg transition-all duration-200 group">
                    @if($attachment->isImage())
                    <svg class="w-5 h-5 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    @else
                    <svg class="w-5 h-5 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    @endif
                    <span class="text-sm font-medium text-[#65B741] group-hover:underline">{{ $attachment->file_name }}</span>
                </a>
                @endforeach
        <!-- Chat Section -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm" id="chatSection">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Chat with Staff</h3>
                    <p class="text-xs text-gray-500 mt-1">Follow up on your report</p>
                </div>

                <!-- Chat Messages -->
                <div id="chatMessages" class="h-96 overflow-y-auto p-4 space-y-4 bg-gray-50">
                    <div class="text-center text-gray-500 text-sm py-8">
                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p>No messages yet. Start the conversation!</p>
                    </div>
                </div>

                <!-- Chat Input -->
                <div class="p-4 border-t border-gray-200 bg-white">
                    @if(session('user'))
                        <form id="chatForm" class="space-y-2">
                            <!-- File Upload Area -->
                            <div id="chatFilePreview" class="hidden mb-2">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <div id="chatFileList" class="flex items-center gap-2 flex-wrap"></div>
                                    <button type="button" onclick="clearChatFiles()" class="text-xs text-red-600 hover:text-red-800 font-semibold">Clear All</button>
                                </div>
                            </div>
                            
                            <div class="flex gap-2">
                                <div class="flex-1 relative">
                                    <input type="text" id="chatInput" placeholder="Type your message..." class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-[#65B741] outline-none" required>
                                    <input type="file" id="chatFileInput" multiple accept="image/*,.pdf,.doc,.docx" class="hidden">
                                </div>
                                <button type="button" onclick="document.getElementById('chatFileInput').click()" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors" title="Attach file">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                </button>
                                <button type="submit" class="px-4 py-2 bg-[#65B741] text-white rounded-lg hover:bg-[#4d8a32] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-4">
                            <p class="text-sm text-gray-600 mb-3">Please log in to chat</p>
                            <a href="{{ route('login') }}" class="text-sm text-[#65B741] hover:text-[#4d8a32] font-semibold">Login</a>
                        </div>
                    @endif
                </div>
>>>>>>> 1aba87a0d1f507d0444bbc2b39e38f65ec486f9f
            </div>
        </div>
        @endif
    </div>

    <!-- Messages/Chat -->
    <div class="bg-white p-6 lg:p-8 mb-6 rounded-lg border border-gray-200 shadow-sm">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Conversation</h2>
        
        <div class="space-y-6 max-h-[500px] overflow-y-auto mb-6 pr-2">
            @forelse($ticket->messages as $message)
            <div class="flex {{ $message->sender_id === $profile->id ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-[75%] sm:max-w-[65%]">
                    <div class="flex items-center space-x-2 mb-2 {{ $message->sender_id === $profile->id ? 'justify-end' : 'justify-start' }}">
                        <span class="text-sm font-semibold text-gray-900">{{ $message->sender->name }}</span>
                        <span class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="rounded-2xl p-4 {{ $message->sender_id === $profile->id ? 'bg-[#65B741] text-white rounded-tr-sm' : 'bg-gray-100 text-gray-900 rounded-tl-sm' }}">
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
                                <a href="{{ $attachment->file_url }}" target="_blank" class="flex items-center space-x-2 {{ $message->sender_id === $profile->id ? 'text-white hover:text-white/80' : 'text-[#65B741] hover:text-[#4d8a32]' }} transition-colors">
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
            <div class="text-center py-12">
                <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <p class="text-gray-600">No messages yet. Start the conversation!</p>
            </div>
            @endforelse
        </div>

        <!-- Message Form -->
        <form method="POST" action="{{ route('reports.messages.store', $ticket->id) }}" enctype="multipart/form-data" class="border-t border-gray-200 pt-6">
            @csrf
            
            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="mb-4">
                <textarea 
                    name="content" 
                    rows="3"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none bg-white"
                    placeholder="Type your message..."
                ></textarea>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <label class="flex items-center space-x-2 cursor-pointer group">
                    <input type="file" name="attachments[]" multiple class="hidden" id="message-attachments" accept="image/*,application/pdf,.doc,.docx" onchange="updateAttachmentLabel(this)">
                    <span class="flex items-center space-x-2 px-4 py-2 border-2 border-gray-300 rounded-lg text-sm text-gray-600 hover:border-[#65B741] hover:text-[#65B741] hover:bg-[#65B741]/10 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <span id="attachment-label">Attach Files</span>
                    </span>
                </label>
                <button 
                    type="submit" 
                    class="px-8 py-2 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 w-full sm:w-auto"
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
