@extends('layouts.app')

@section('title', 'Suggestion Details - Community Hub')

@section('content')
@php
    // Map content to description for view compatibility
    if (isset($suggestion['content'])) {
        $suggestion['description'] = $suggestion['content'];
    }
    
    // Sample comments (can be replaced with database comments later)
    $comments = [
        ['id' => 1, 'author' => 'Carlos Rivera', 'date' => '2 days ago', 'text' => 'Great idea! I would love to participate in this.'],
        ['id' => 2, 'author' => 'Liza Garcia', 'date' => '2 days ago', 'text' => 'This is exactly what our community needs. I can help organize if needed.'],
    ];
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

    <!-- Comments Section -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 lg:p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Comments ({{ count($comments) }})</h2>
        
        <!-- Comments List -->
        <div id="commentsList" class="space-y-4 mb-6">
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
        </div>

        <!-- Add Comment Section -->
        <div class="pt-4 border-t border-gray-200">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Add a Comment</h3>
            
            @if(session('user'))
                <!-- Comment Form (login required) -->
                <form id="commentForm" class="space-y-3">
                    <textarea id="commentText" rows="3" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none" placeholder="Write your comment..."></textarea>
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
    // Set current user info
    window.currentUserEmail = '{{ session("user")["email"] }}';
    window.currentUserName = '{{ session("user")["name"] }}';
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const suggestionId = {{ $suggestion['id'] }};
    const upvoteBtn = document.getElementById('upvoteBtn');
    const upvoteText = document.getElementById('upvoteText');
    const commentForm = document.getElementById('commentForm');
    const commentsContainer = document.getElementById('commentsList');
    const commentCountEl = document.getElementById('commentCount');
    
    // Load saved votes and comments from localStorage
    const votesKey = 'suggestion_votes_' + suggestionId;
    const commentsKey = 'suggestion_comments_' + suggestionId;
    const userEmail = window.currentUserEmail;
    
    // Check if user has already voted
    const userVotes = JSON.parse(localStorage.getItem('user_suggestion_votes') || '{}');
    const hasVoted = userVotes[suggestionId] && userVotes[suggestionId].includes(userEmail);
    
    if (hasVoted && upvoteBtn) {
        upvoteBtn.classList.remove('bg-gray-100', 'border', 'border-gray-300', 'text-gray-700');
        upvoteBtn.classList.add('bg-[#65B741]', 'text-white');
        upvoteText.textContent = '{{ $suggestion["upvotes"] + 1 }} Upvoted';
    }
    
    // Load saved comments from localStorage
    const savedComments = JSON.parse(localStorage.getItem(commentsKey) || '[]');
    if (savedComments.length > 0) {
        savedComments.forEach(comment => {
            const timeAgo = getTimeAgo(comment.date);
            const isOwnComment = comment.userEmail === userEmail;
            const initial = comment.userName ? comment.userName.charAt(0).toUpperCase() : 'U';
            
            // Right side for own comments, left side for others
            const commentHtml = isOwnComment ? `
                <div class="pb-4 border-b border-gray-100 last:border-0">
                    <div class="flex items-start gap-3 justify-end">
                        <div class="flex-1 max-w-[80%]">
                            <div class="flex items-center gap-2 mb-1 justify-end">
                                <span class="text-xs text-gray-500">${timeAgo}</span>
                                <span class="font-semibold text-gray-900 text-sm">${comment.userName || 'You'}</span>
                            </div>
                            <div class="bg-[#65B741]/10 border border-[#65B741]/20 rounded-lg p-3 ml-auto">
                                <p class="text-gray-700 text-sm leading-relaxed">${comment.text}</p>
                            </div>
                        </div>
                        <div class="w-10 h-10 bg-[#65B741] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-semibold text-sm">${initial}</span>
                        </div>
                    </div>
                </div>
            ` : `
                <div class="pb-4 border-b border-gray-100 last:border-0">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-gray-600 font-semibold text-sm">${initial}</span>
                        </div>
                        <div class="flex-1 max-w-[80%]">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-semibold text-gray-900 text-sm">${comment.userName || 'User'}</span>
                                <span class="text-xs text-gray-500">${timeAgo}</span>
                            </div>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                                <p class="text-gray-700 text-sm leading-relaxed">${comment.text}</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            commentsContainer.insertAdjacentHTML('beforeend', commentHtml);
        });
        // Update comment count
        const totalComments = {{ count($comments) }} + savedComments.length;
        commentCountEl.textContent = totalComments + ' Comments';
    }
    
    function getTimeAgo(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffInSeconds = Math.floor((now - date) / 1000);
        
        if (diffInSeconds < 60) return 'Just now';
        if (diffInSeconds < 3600) return Math.floor(diffInSeconds / 60) + ' minutes ago';
        if (diffInSeconds < 86400) return Math.floor(diffInSeconds / 3600) + ' hours ago';
        if (diffInSeconds < 604800) return Math.floor(diffInSeconds / 86400) + ' days ago';
        return Math.floor(diffInSeconds / 604800) + ' weeks ago';
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
    
    // Handle comment submission
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const commentText = document.getElementById('commentText').value.trim();
            
            if (!commentText) {
                alert('Please enter a comment');
                return;
            }
            
            // Save comment to localStorage
            const savedComments = JSON.parse(localStorage.getItem(commentsKey) || '[]');
            const newComment = {
                id: Date.now(),
                userEmail: userEmail,
                userName: window.currentUserName || 'User',
                text: commentText,
                date: new Date().toISOString()
            };
            
            savedComments.push(newComment);
            localStorage.setItem(commentsKey, JSON.stringify(savedComments));
            
            // Add comment to UI (always on right side since it's the current user's comment)
            const initial = (window.currentUserName || 'User').charAt(0).toUpperCase();
            const commentHtml = `
                <div class="pb-4 border-b border-gray-100 last:border-0">
                    <div class="flex items-start gap-3 justify-end">
                        <div class="flex-1 max-w-[80%]">
                            <div class="flex items-center gap-2 mb-1 justify-end">
                                <span class="text-xs text-gray-500">Just now</span>
                                <span class="font-semibold text-gray-900 text-sm">${window.currentUserName || 'You'}</span>
                            </div>
                            <div class="bg-[#65B741]/10 border border-[#65B741]/20 rounded-lg p-3 ml-auto">
                                <p class="text-gray-700 text-sm leading-relaxed">${commentText}</p>
                            </div>
                        </div>
                        <div class="w-10 h-10 bg-[#65B741] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-semibold text-sm">${initial}</span>
                        </div>
                    </div>
                </div>
            `;
            
            commentsContainer.insertAdjacentHTML('beforeend', commentHtml);
            
            // Update comment count
            const currentCount = parseInt(commentCountEl.textContent.match(/\d+/)[0]);
            commentCountEl.textContent = (currentCount + 1) + ' Comments';
            
            // Clear form
            document.getElementById('commentText').value = '';
        });
    }
});
</script>
@endif
@endsection
