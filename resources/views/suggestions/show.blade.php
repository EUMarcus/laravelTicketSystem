@extends('layouts.app')

@section('title', 'Suggestion Details - Community Hub')

@section('content')
@php
    // NOTE: No login required - using browser localStorage for temporary user tracking
    // When Supabase is integrated, you can optionally require login or keep it open
    
    // Same dataset as index page
    $allSuggestions = [
        ['id' => 1, 'title' => 'Weekly Community Exercise Program', 'category' => 'Health', 'upvotes' => 45, 'comments' => 12, 'author' => 'Maria Santos', 'date' => '3 days ago', 'description' => 'I suggest organizing a weekly community exercise program in the barangay park. This would include Zumba, yoga, or simple aerobics sessions every Saturday morning. This will help promote health and wellness among residents, especially seniors and stay-at-home parents. We can invite volunteer instructors or partner with fitness professionals in our community.'],
        ['id' => 2, 'title' => 'Install Solar-Powered Streetlights', 'category' => 'Infrastructure', 'upvotes' => 89, 'comments' => 23, 'author' => 'Anonymous', 'date' => '1 week ago', 'description' => 'Proposing to install solar-powered streetlights throughout the barangay to reduce electricity costs and promote environmental sustainability. This would improve safety while being eco-friendly.'],
        ['id' => 3, 'title' => 'Monthly Barangay Festival', 'category' => 'Events', 'upvotes' => 156, 'comments' => 34, 'author' => 'Juan Dela Cruz', 'date' => '2 weeks ago', 'description' => 'Organize a monthly barangay festival to celebrate our community spirit. Each month can have a different theme - food, music, arts, sports, etc. This will bring residents together and strengthen community bonds.'],
        ['id' => 4, 'title' => 'Free Computer Literacy Classes', 'category' => 'Education', 'upvotes' => 67, 'comments' => 15, 'author' => 'Ana Reyes', 'date' => '1 week ago', 'description' => 'Offer free computer literacy classes for seniors and adults who want to learn basic computer skills. This will help bridge the digital divide in our community.'],
        ['id' => 5, 'title' => 'Community Garden Project', 'category' => 'Environment', 'upvotes' => 112, 'comments' => 28, 'author' => 'Pedro Martinez', 'date' => '5 days ago', 'description' => 'Create a community garden where residents can grow vegetables and herbs. This promotes healthy eating, environmental awareness, and community cooperation.'],
        ['id' => 6, 'title' => 'Youth Sports Tournament', 'category' => 'Sports', 'upvotes' => 78, 'comments' => 19, 'author' => 'Anonymous', 'date' => '4 days ago', 'description' => 'Organize quarterly youth sports tournaments (basketball, volleyball, badminton) to keep young people active and engaged in positive activities.'],
    ];
    
    // Find the suggestion by ID
    $suggestion = collect($allSuggestions)->firstWhere('id', (int)$id);
    
    // If suggestion not found, show 404
    if (!$suggestion) {
        abort(404, 'Suggestion not found');
    }
    
    // Sample comments
    $comments = [
        ['id' => 1, 'author' => 'Carlos Rivera', 'date' => '2 days ago', 'text' => 'Great idea! I would love to participate in this. Count me in for the Zumba sessions.'],
        ['id' => 2, 'author' => 'Liza Garcia', 'date' => '2 days ago', 'text' => 'This is exactly what our community needs. I can help organize if needed.'],
        ['id' => 3, 'author' => 'Roberto Cruz', 'date' => '1 day ago', 'text' => 'I know a fitness instructor who might be willing to volunteer. Let me reach out to them.'],
        ['id' => 4, 'author' => 'Anonymous', 'date' => '1 day ago', 'text' => 'Would this be free for all residents? What about equipment needs?'],
        ['id' => 5, 'author' => 'Maria Santos', 'date' => '1 day ago', 'text' => 'Yes, it would be completely free! We can use the existing park space and minimal equipment.'],
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
            <button id="upvoteBtn" class="flex items-center gap-2 px-6 py-3 bg-gray-100 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-200 font-semibold transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                </svg>
                <span id="upvoteText">{{ $suggestion['upvotes'] }} Upvotes</span>
            </button>
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
            
            <!-- Comment Form (no login required) -->
            <form id="commentForm" class="space-y-3">
                <div>
                    <input type="text" id="commenterName" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none mb-2" placeholder="Your name (optional - we'll remember it)">
                    <p class="text-xs text-gray-500">Leave blank to comment as Anonymous</p>
                </div>
                <textarea id="commentText" rows="3" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none" placeholder="Write your comment..."></textarea>
                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" id="commentAnonymous" class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                        <span class="ml-2 text-sm text-gray-700">Post as Anonymous</span>
                    </label>
                    <button type="submit" class="px-6 py-2 bg-gray-900 text-white rounded-lg text-sm font-semibold hover:bg-gray-800">
                        Post Comment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Temporary User Management (Frontend-only, until Supabase integration)
class TemporaryAuth {
    constructor() {
        this.userIdKey = 'suggestion_user_id';
        this.userNameKey = 'suggestion_user_name';
        this.votesKey = 'suggestion_votes';
        this.commentsKey = 'suggestion_comments';
    }

    getUserId() {
        let userId = localStorage.getItem(this.userIdKey);
        if (!userId) {
            userId = 'temp_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem(this.userIdKey, userId);
        }
        return userId;
    }

    getUserName() {
        return localStorage.getItem(this.userNameKey) || 'Anonymous';
    }

    setUserName(name) {
        if (name && name.trim()) {
            localStorage.setItem(this.userNameKey, name.trim());
        }
    }

    hasVoted(suggestionId) {
        const votes = this.getVotes();
        return votes.includes(suggestionId.toString());
    }

    recordVote(suggestionId) {
        const votes = this.getVotes();
        if (!votes.includes(suggestionId.toString())) {
            votes.push(suggestionId.toString());
            localStorage.setItem(this.votesKey, JSON.stringify(votes));
            return true;
        }
        return false;
    }

    removeVote(suggestionId) {
        const votes = this.getVotes();
        const index = votes.indexOf(suggestionId.toString());
        if (index > -1) {
            votes.splice(index, 1);
            localStorage.setItem(this.votesKey, JSON.stringify(votes));
            return true;
        }
        return false;
    }

    getVotes() {
        const votes = localStorage.getItem(this.votesKey);
        return votes ? JSON.parse(votes) : [];
    }

    saveComment(suggestionId, comment) {
        const comments = this.getAllComments();
        const commentData = {
            id: Date.now(),
            suggestionId: suggestionId.toString(),
            userId: this.getUserId(),
            userName: comment.userName || (comment.anonymous ? 'Anonymous' : this.getUserName()),
            text: comment.text,
            anonymous: comment.anonymous || false,
            date: new Date().toISOString()
        };
        
        if (!comments[suggestionId]) {
            comments[suggestionId] = [];
        }
        comments[suggestionId].push(commentData);
        localStorage.setItem(this.commentsKey, JSON.stringify(comments));
        return commentData;
    }

    getAllComments() {
        const comments = localStorage.getItem(this.commentsKey);
        return comments ? JSON.parse(comments) : {};
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const auth = new TemporaryAuth();
    const suggestionId = {{ $suggestion['id'] }};
    const upvoteBtn = document.getElementById('upvoteBtn');
    const upvoteText = document.getElementById('upvoteText');
    const commentForm = document.getElementById('commentForm');
    const commenterNameInput = document.getElementById('commenterName');
    const commentsContainer = document.getElementById('commentsList');
    const commentCountEl = document.getElementById('commentCount');
    
    // Load saved comments from localStorage
    const currentUserId = auth.getUserId();
    const savedComments = auth.getAllComments()[suggestionId] || [];
    if (savedComments.length > 0) {
        savedComments.forEach(comment => {
            const timeAgo = getTimeAgo(comment.date);
            const isOwnComment = comment.userId === currentUserId;
            const initial = comment.anonymous ? 'A' : (comment.userName !== 'Anonymous' ? comment.userName.charAt(0).toUpperCase() : 'A');
            
            // Right side for own comments, left side for others
            const commentHtml = isOwnComment ? `
                <div class="pb-4 border-b border-gray-100 last:border-0">
                    <div class="flex items-start gap-3 justify-end">
                        <div class="flex-1 max-w-[80%]">
                            <div class="flex items-center gap-2 mb-1 justify-end">
                                <span class="text-xs text-gray-500">${timeAgo}</span>
                                <span class="font-semibold text-gray-900 text-sm">${comment.anonymous ? 'Anonymous' : comment.userName}</span>
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
                                <span class="font-semibold text-gray-900 text-sm">${comment.anonymous ? 'Anonymous' : comment.userName}</span>
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
    
    // Load saved user name
    const savedName = auth.getUserName();
    if (savedName && savedName !== 'Anonymous') {
        commenterNameInput.value = savedName;
    }
    
    // Check if user has already voted
    const hasVoted = auth.hasVoted(suggestionId);
    if (hasVoted) {
        upvoteBtn.classList.remove('bg-gray-100', 'border', 'border-gray-300', 'text-gray-700');
        upvoteBtn.classList.add('bg-[#65B741]', 'text-white');
        upvoteText.textContent = '{{ $suggestion["upvotes"] + 1 }} Upvoted';
    }
    
    // Handle upvote
    if (upvoteBtn) {
        upvoteBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const hasVoted = auth.hasVoted(suggestionId);
            
            if (hasVoted) {
                // Remove vote
                if (auth.removeVote(suggestionId)) {
                    this.classList.remove('bg-[#65B741]', 'text-white');
                    this.classList.add('bg-gray-100', 'border', 'border-gray-300', 'text-gray-700');
                    upvoteText.textContent = '{{ $suggestion["upvotes"] }} Upvotes';
                }
            } else {
                // Add vote - prevent duplicate
                if (auth.recordVote(suggestionId)) {
                    this.classList.remove('bg-gray-100', 'border', 'border-gray-300', 'text-gray-700');
                    this.classList.add('bg-[#65B741]', 'text-white');
                    upvoteText.textContent = '{{ $suggestion["upvotes"] + 1 }} Upvoted';
                } else {
                    alert('You have already voted on this suggestion!');
                }
            }
        });
    }
    
    // Handle comment submission
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const commentText = document.getElementById('commentText').value.trim();
            const isAnonymous = document.getElementById('commentAnonymous').checked;
            const userName = commenterNameInput.value.trim();
            
            if (!commentText) {
                alert('Please enter a comment');
                return;
            }
            
            // Save user name if provided (even if anonymous, save for future use)
            if (userName && userName.trim()) {
                auth.setUserName(userName.trim());
            }
            
            // Get the name to use for comment (use saved name if available and not anonymous)
            const nameToUse = isAnonymous ? 'Anonymous' : (userName && userName.trim() ? userName.trim() : auth.getUserName());
            
            // Save comment
            const comment = auth.saveComment(suggestionId, {
                text: commentText,
                anonymous: isAnonymous,
                userName: nameToUse
            });
            
            // Add comment to UI (always on right side since it's the current user's comment)
            const displayName = isAnonymous ? 'Anonymous' : nameToUse;
            const initial = isAnonymous ? 'A' : (nameToUse !== 'Anonymous' ? nameToUse.charAt(0).toUpperCase() : 'A');
            const commentHtml = `
                <div class="pb-4 border-b border-gray-100 last:border-0">
                    <div class="flex items-start gap-3 justify-end">
                        <div class="flex-1 max-w-[80%]">
                            <div class="flex items-center gap-2 mb-1 justify-end">
                                <span class="text-xs text-gray-500">Just now</span>
                                <span class="font-semibold text-gray-900 text-sm">${displayName}</span>
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
            document.getElementById('commentAnonymous').checked = false;
        });
    }
});
</script>
@endsection
