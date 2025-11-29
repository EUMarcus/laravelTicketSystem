@extends('layouts.app')

@section('title', 'Create Suggestion - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Create Suggestion</h1>
                <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Share your ideas to improve our community</p>
            </div>
            <a href="{{ route('suggestions.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Suggestions</span>
            </a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <!-- Main Content - Suggestion Form -->
        <div>
            @if(!session('user'))
                <!-- Login Required Notice -->
                <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm text-center mb-6">
                    <div class="max-w-md mx-auto">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-[#65B741]/10 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Login Required</h3>
                        <p class="text-gray-600 mb-6">You need to be logged in to submit a suggestion. This helps us track and respond to your ideas effectively.</p>
                        <div class="flex gap-3 justify-center">
                            <a href="{{ route('login') }}" class="px-8 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50">
                                Register
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Suggestion Form -->
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Share Your Suggestion</h2>
                    <form id="suggestionForm" class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Category <span class="text-gray-400 font-normal">(Optional)</span></label>
                            <select id="suggestionCategory" name="category" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white">
                                <option value="">Select Category</option>
                                <option value="Health">Health</option>
                                <option value="Infrastructure">Infrastructure</option>
                                <option value="Events">Events</option>
                                <option value="Education">Education</option>
                                <option value="Environment">Environment</option>
                                <option value="Sports">Sports</option>
                                <option value="Safety">Safety</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Title <span class="text-red-500">*</span></label>
                            <input type="text" id="suggestionTitle" name="title" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="Brief title for your suggestion" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Description <span class="text-red-500">*</span></label>
                            <textarea id="suggestionDescription" name="description" rows="6" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none bg-white" placeholder="Describe your suggestion in detail..." required></textarea>
                        </div>

                        <div class="flex gap-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('suggestions.index') }}" class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 flex-1">
                                Submit Suggestion
                            </button>
                        </div>
                    </form>
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
    const form = document.getElementById('suggestionForm');

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Get form data
        const category = document.getElementById('suggestionCategory').value;
        const title = document.getElementById('suggestionTitle').value;
        const description = document.getElementById('suggestionDescription').value;

        // Save suggestion to localStorage
        const suggestions = JSON.parse(localStorage.getItem('user_suggestions') || '[]');
        const newSuggestion = {
            id: 'SUG-' + Date.now() + '-' + Math.random().toString(36).substr(2, 3).toUpperCase(),
            category: category || 'Other',
            title: title,
            description: description,
            upvotes: 0,
            comments: 0,
            author: window.currentUserName || 'Unknown',
            userEmail: window.currentUserEmail,
            createdAt: new Date().toISOString(),
            date: 'Just now'
        };

        suggestions.push(newSuggestion);
        localStorage.setItem('user_suggestions', JSON.stringify(suggestions));

        // Show success message and redirect
        alert('Suggestion submitted successfully!');
        window.location.href = '{{ route("suggestions.index") }}';
    });
});
</script>
@endif
@endsection
