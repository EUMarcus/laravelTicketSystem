@extends('layouts.app')

@section('title', 'Suggestion Details - Community Hub')

@section('content')
@php
    // Map content to description for view compatibility
    if (isset($suggestion['content'])) {
        $suggestion['description'] = $suggestion['content'];
    }
    
    // Comments are passed from the controller
    // $comments variable is available from the controller
@endphp

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ (session('user') && in_array(session('user')['role'] ?? '', ['employee', 'admin'])) ? route('staff.suggestions') : route('suggestions.index') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-[#65B741] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-medium">Back to Suggestions</span>
        </a>
    </div>

    <!-- Suggestion Details Card -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 lg:p-8 mb-6">
        <!-- Header -->
        <div class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                <div class="flex-1">
            <div class="flex items-center gap-2 flex-wrap mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                    {{ $suggestion['category'] }}
                </span>
                        @if(isset($suggestion['status']))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            @if($suggestion['status'] === 'approved') bg-green-100 text-green-700 border border-green-200
                            @elseif($suggestion['status'] === 'rejected') bg-red-100 text-red-700 border border-red-200
                            @elseif($suggestion['status'] === 'processing') bg-blue-100 text-blue-700 border border-blue-200
                            @elseif($suggestion['status'] === 'considering') bg-yellow-100 text-yellow-700 border border-yellow-200
                            @else bg-gray-100 text-gray-700 border border-gray-200 @endif">
                            {{ ucfirst($suggestion['status']) }}
                        </span>
                        @endif
            </div>
            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">{{ $suggestion['title'] }}</h1>
            <div class="flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>By {{ $suggestion['author'] }}</span>
                <span class="mx-2">•</span>
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ $suggestion['date'] }}</span>
                    </div>
                </div>
                @if(session('user') && in_array(session('user')['role'] ?? '', ['employee', 'admin']))
                <form method="POST" action="{{ route('suggestions.status.update', $suggestion['id']) }}" class="flex-shrink-0">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()" class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white cursor-pointer">
                        <option value="pending" {{ ($suggestion['status'] ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="considering" {{ ($suggestion['status'] ?? 'pending') === 'considering' ? 'selected' : '' }}>Considering</option>
                        <option value="processing" {{ ($suggestion['status'] ?? 'pending') === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="approved" {{ ($suggestion['status'] ?? 'pending') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ ($suggestion['status'] ?? 'pending') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>
                @endif
            </div>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Description</h2>
            <div class="bg-gray-50 border border-gray-100 rounded-lg p-4 lg:p-6">
                <p class="text-gray-700 leading-relaxed text-base whitespace-pre-wrap">{{ $suggestion['description'] }}</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
            @if(session('user'))
                <button id="upvoteBtn" class="flex items-center gap-2 px-6 py-3 bg-gray-100 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-200 font-semibold transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                    </svg>
                    <span id="upvoteText">{{ $suggestion['upvotes'] }} Upvotes</span>
                </button>
            @else
                <a href="{{ route('login') }}" class="flex items-center gap-2 px-6 py-3 bg-gray-100 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-200 font-semibold transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                    </svg>
                    <span>Login to Vote</span>
                </a>
            @endif
            <div class="flex items-center gap-2 text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span class="font-medium" id="commentCount">{{ $suggestion['comments'] }} Comments</span>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 lg:p-8">
        <div class="flex items-center gap-3 mb-6">
            <h2 class="text-xl font-bold text-gray-900">Comments</h2>
            <span class="px-2.5 py-0.5 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold" id="commentCountBadge">{{ count($comments ?? []) }}</span>
        </div>
        
        <!-- Comments List -->
        <div id="commentsList" class="space-y-5 mb-8">
            @if(isset($comments) && count($comments) > 0)
                @foreach($comments as $comment)
                @php
                    $isMyComment = session('user') && isset($comment['comment_from']) && $comment['comment_from'] === session('user')['id'];
                @endphp
                <div class="pb-5 border-b border-gray-100 last:border-0 last:pb-0">
                    <div class="flex items-start gap-4 {{ $isMyComment ? 'justify-end' : 'justify-start' }}">
                        @if(!$isMyComment)
                        <div class="w-10 h-10 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-semibold text-sm">{{ strtoupper(substr($comment['author'] ?? 'A', 0, 1)) }}</span>
                        </div>
                        @endif
                        <div class="{{ $isMyComment ? 'max-w-[75%]' : 'max-w-[75%]' }} flex flex-col {{ $isMyComment ? 'items-end' : 'items-start' }}">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="font-semibold text-gray-900 text-sm">{{ $comment['author'] ?? 'Anonymous' }}</span>
                                <span class="text-xs text-gray-500">•</span>
                                <span class="text-xs text-gray-500">{{ $comment['date'] }}</span>
                            </div>
                            <div class="{{ $isMyComment ? 'bg-[#65B741] text-white rounded-tr-sm' : 'bg-gray-50 border border-gray-100 rounded-tl-sm' }} rounded-lg p-4">
                                <p class="{{ $isMyComment ? 'text-white' : 'text-gray-700' }} text-sm leading-relaxed whitespace-pre-wrap">{{ $comment['text'] }}</p>
                            </div>
                        </div>
                        @if($isMyComment)
                        <div class="w-10 h-10 bg-[#65B741] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-semibold text-sm">{{ strtoupper(substr(session('user')['name'] ?? 'M', 0, 1)) }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <p class="text-gray-600 font-medium">No comments yet</p>
                    <p class="text-gray-500 text-sm mt-1">Be the first to share your thoughts!</p>
                </div>
            @endif
        </div>

        <!-- Add Comment Section -->
        <div class="pt-6 border-t border-gray-200">
            <h3 class="text-base font-semibold text-gray-900 mb-4">Add a Comment</h3>
            
            @if(session('user'))
                <!-- Comment Form (login required) -->
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form id="commentForm" method="POST" action="{{ route('suggestions.comments.store', $suggestion['id']) }}" class="space-y-4">
                    @csrf
                    <div>
                        <textarea id="commentText" name="comment" rows="4" required class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none" placeholder="Share your thoughts...">{{ old('comment') }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-gray-900 text-white rounded-lg text-sm font-semibold hover:bg-gray-800 transition-colors">
                            Post Comment
                        </button>
                    </div>
                </form>
                
                <script>
                // Clear form after successful submission
                document.addEventListener('DOMContentLoaded', function() {
                    const commentForm = document.getElementById('commentForm');
                    const commentText = document.getElementById('commentText');
                    
                    if (commentForm && commentText) {
                        // Check if we just posted a comment (no errors and form was submitted)
                        @if(session('_old_input.comment') === null && !$errors->any())
                            commentText.value = '';
                        @endif
                    }
                });
                </script>
            @else
                <!-- Login Required Notice -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                    <svg class="w-10 h-10 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <p class="text-sm text-gray-700 font-medium mb-4">You need to be logged in to comment on suggestions.</p>
                    <div class="flex gap-3 justify-center">
                        <a href="{{ route('login') }}" class="px-6 py-2.5 bg-gray-900 text-white rounded-lg text-sm font-semibold hover:bg-gray-800 transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
                            Register
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@if(session('user'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    const suggestionId = '{{ $suggestion["id"] }}';
    const upvoteBtn = document.getElementById('upvoteBtn');
    const upvoteText = document.getElementById('upvoteText');
    const userEmail = '{{ session("user")["email"] }}';
    const commentCountBadge = document.getElementById('commentCountBadge');
    
    // Check if user has already voted (localStorage for upvotes - can be moved to database later)
    const userVotes = JSON.parse(localStorage.getItem('user_suggestion_votes') || '{}');
    const hasVoted = userVotes[suggestionId] && userVotes[suggestionId].includes(userEmail);
    
    if (hasVoted && upvoteBtn) {
        upvoteBtn.classList.remove('bg-gray-100', 'border', 'border-gray-300', 'text-gray-700');
        upvoteBtn.classList.add('bg-[#65B741]', 'text-white', 'border-[#65B741]');
        upvoteText.textContent = '{{ $suggestion["upvotes"] + 1 }} Upvoted';
    }
    
    // Handle upvote
    if (upvoteBtn) {
        upvoteBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const userVotes = JSON.parse(localStorage.getItem('user_suggestion_votes') || '{}');
            const hasVoted = userVotes[suggestionId] && userVotes[suggestionId].includes(userEmail);
            
            if (hasVoted) {
                // Remove vote
                if (!userVotes[suggestionId]) userVotes[suggestionId] = [];
                userVotes[suggestionId] = userVotes[suggestionId].filter(email => email !== userEmail);
                localStorage.setItem('user_suggestion_votes', JSON.stringify(userVotes));
                
                this.classList.remove('bg-[#65B741]', 'text-white', 'border-[#65B741]');
                this.classList.add('bg-gray-100', 'border', 'border-gray-300', 'text-gray-700');
                upvoteText.textContent = '{{ $suggestion["upvotes"] }} Upvotes';
            } else {
                // Add vote
                if (!userVotes[suggestionId]) userVotes[suggestionId] = [];
                if (!userVotes[suggestionId].includes(userEmail)) {
                    userVotes[suggestionId].push(userEmail);
                    localStorage.setItem('user_suggestion_votes', JSON.stringify(userVotes));
                    
                    this.classList.remove('bg-gray-100', 'border', 'border-gray-300', 'text-gray-700');
                    this.classList.add('bg-[#65B741]', 'text-white', 'border-[#65B741]');
                    upvoteText.textContent = '{{ $suggestion["upvotes"] + 1 }} Upvoted';
                }
            }
        });
    }
    
    // Update comment count badge if form is submitted successfully
    const commentForm = document.getElementById('commentForm');
    if (commentForm) {
        commentForm.addEventListener('submit', function() {
            // Update badge after a short delay to allow server response
            setTimeout(function() {
                if (commentCountBadge) {
                    const currentCount = parseInt(commentCountBadge.textContent) || 0;
                    commentCountBadge.textContent = currentCount + 1;
                }
            }, 500);
        });
    }
});
</script>
@endif
@endsection
