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

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('suggestions.index') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900">
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
            <div class="flex items-center gap-2 flex-wrap mb-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                    {{ $suggestion['category'] }}
            </span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">{{ $suggestion['title'] }}</h1>
            <div class="flex items-center text-sm text-gray-500 mb-4">
                <span>By {{ $suggestion['author'] }}</span>
                <span class="mx-2">•</span>
                <span>{{ $suggestion['date'] }}</span>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-3">Description</h2>
            <p class="text-gray-700 leading-relaxed text-base">{{ $suggestion['description'] }}</p>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-6 pt-6 border-t border-gray-200">
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

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6">
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Comments Section -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 lg:p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Comments ({{ count($comments ?? []) }})</h2>
        
        <!-- Comments List -->
        <div id="commentsList" class="space-y-4 mb-6">
            @if(isset($comments) && count($comments) > 0)
                @foreach($comments as $comment)
                <div class="pb-4 border-b border-gray-100 last:border-0">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-gray-600 font-semibold text-sm">{{ substr($comment['author'], 0, 1) }}</span>
                        </div>
                        <div class="flex-1 max-w-[80%]">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-semibold text-gray-900 text-sm">{{ $comment['author'] }}</span>
                                <span class="text-xs text-gray-500">{{ $comment['date'] }}</span>
                            </div>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $comment['text'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center py-8 text-gray-500">
                    <p>No comments yet. Be the first to comment!</p>
                </div>
            @endif
        </div>

        <!-- Add Comment Section -->
        <div class="pt-4 border-t border-gray-200">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Add a Comment</h3>
            
            @if(session('user'))
                <!-- Comment Form (login required) -->
                @if($errors->any())
                    <div class="mb-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="list-disc list-inside text-red-700 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form id="commentForm" method="POST" action="{{ route('suggestions.comments.store', $suggestion['id']) }}" class="space-y-3">
                    @csrf
                    <textarea id="commentText" name="comment" rows="3" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none" placeholder="Write your comment...">{{ old('comment') }}</textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-gray-900 text-white rounded-lg text-sm font-semibold hover:bg-gray-800">
                            Post Comment
                        </button>
                    </div>
                </form>
            @else
                <!-- Login Required Notice -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                    <p class="text-sm text-gray-600 mb-3">You need to be logged in to comment on suggestions.</p>
                    <div class="flex gap-3 justify-center">
                        <a href="{{ route('login') }}" class="px-6 py-2 bg-gray-900 text-white rounded-lg text-sm font-semibold hover:bg-gray-800">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50">
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
    
    // Check if user has already voted (localStorage for upvotes - can be moved to database later)
    const userVotes = JSON.parse(localStorage.getItem('user_suggestion_votes') || '{}');
    const hasVoted = userVotes[suggestionId] && userVotes[suggestionId].includes(userEmail);
    
    if (hasVoted && upvoteBtn) {
        upvoteBtn.classList.remove('bg-gray-100', 'border', 'border-gray-300', 'text-gray-700');
        upvoteBtn.classList.add('bg-[#65B741]', 'text-white');
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
                
                this.classList.remove('bg-[#65B741]', 'text-white');
                this.classList.add('bg-gray-100', 'border', 'border-gray-300', 'text-gray-700');
                upvoteText.textContent = '{{ $suggestion["upvotes"] }} Upvotes';
            } else {
                // Add vote
                if (!userVotes[suggestionId]) userVotes[suggestionId] = [];
                if (!userVotes[suggestionId].includes(userEmail)) {
                    userVotes[suggestionId].push(userEmail);
                    localStorage.setItem('user_suggestion_votes', JSON.stringify(userVotes));
                    
                    this.classList.remove('bg-gray-100', 'border', 'border-gray-300', 'text-gray-700');
                    this.classList.add('bg-[#65B741]', 'text-white');
                    upvoteText.textContent = '{{ $suggestion["upvotes"] + 1 }} Upvoted';
                }
            }
        });
    }
});
</script>
@endif
@endsection
