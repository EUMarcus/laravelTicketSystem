@extends('layouts.app')

@section('title', 'Poll Details - Community Hub')

@section('content')
@php
    // Same dataset as index page
    $allPolls = [
        ['id' => 1, 'question' => 'Preferred Day for Community Market', 'description' => 'Which day works best for a weekly community market? We want to choose a day that works for most residents.', 'deadline' => 'Dec 15, 2024', 'status' => 'open', 'votes' => 234, 'category' => 'Community', 'options' => [
            ['id' => 1, 'text' => 'Saturday Morning', 'votes' => 89, 'percentage' => 38],
            ['id' => 2, 'text' => 'Sunday Morning', 'votes' => 67, 'percentage' => 29],
            ['id' => 3, 'text' => 'Saturday Afternoon', 'votes' => 45, 'percentage' => 19],
            ['id' => 4, 'text' => 'No Preference', 'votes' => 33, 'percentage' => 14],
        ]],
        ['id' => 2, 'question' => 'Community Garden Location', 'description' => 'Where should we establish the new community garden? Help us decide the best location for everyone.', 'deadline' => 'Dec 20, 2024', 'status' => 'open', 'votes' => 156, 'category' => 'Infrastructure', 'options' => [
            ['id' => 1, 'text' => 'Near Community Center', 'votes' => 78, 'percentage' => 50],
            ['id' => 2, 'text' => 'Park Area', 'votes' => 45, 'percentage' => 29],
            ['id' => 3, 'text' => 'School Grounds', 'votes' => 23, 'percentage' => 15],
            ['id' => 4, 'text' => 'Open Field', 'votes' => 10, 'percentage' => 6],
        ]],
        ['id' => 3, 'question' => 'Festival Theme for New Year', 'description' => 'What theme should we use for the New Year festival? Your input will help shape our celebration.', 'deadline' => 'Nov 30, 2024', 'status' => 'closed', 'votes' => 312, 'category' => 'Events', 'options' => [
            ['id' => 1, 'text' => 'Traditional Filipino', 'votes' => 145, 'percentage' => 46],
            ['id' => 2, 'text' => 'Modern Celebration', 'votes' => 98, 'percentage' => 31],
            ['id' => 3, 'text' => 'Cultural Fusion', 'votes' => 52, 'percentage' => 17],
            ['id' => 4, 'text' => 'Family-Friendly', 'votes' => 17, 'percentage' => 6],
        ]],
        ['id' => 4, 'question' => 'Garbage Collection Schedule', 'description' => 'Should we change the garbage collection schedule? Current schedule is Monday and Thursday.', 'deadline' => 'Dec 25, 2024', 'status' => 'open', 'votes' => 89, 'category' => 'Service', 'options' => [
            ['id' => 1, 'text' => 'Keep Current Schedule', 'votes' => 45, 'percentage' => 51],
            ['id' => 2, 'text' => 'Tuesday and Friday', 'votes' => 28, 'percentage' => 31],
            ['id' => 3, 'text' => 'Wednesday and Saturday', 'votes' => 16, 'percentage' => 18],
        ]],
        ['id' => 5, 'question' => 'Youth Sports Program Activities', 'description' => 'Which sports activities should we include in the youth program? Select your top preferences.', 'deadline' => 'Jan 5, 2025', 'status' => 'open', 'votes' => 167, 'category' => 'Sports', 'options' => [
            ['id' => 1, 'text' => 'Basketball', 'votes' => 78, 'percentage' => 47],
            ['id' => 2, 'text' => 'Volleyball', 'votes' => 45, 'percentage' => 27],
            ['id' => 3, 'text' => 'Badminton', 'votes' => 28, 'percentage' => 17],
            ['id' => 4, 'text' => 'Track and Field', 'votes' => 16, 'percentage' => 9],
        ]],
        ['id' => 6, 'question' => 'Community Center Renovation Priorities', 'description' => 'What should be our priority for the community center renovation? Help us allocate resources wisely.', 'deadline' => 'Dec 10, 2024', 'status' => 'closed', 'votes' => 278, 'category' => 'Infrastructure', 'options' => [
            ['id' => 1, 'text' => 'Roof and Structure', 'votes' => 134, 'percentage' => 48],
            ['id' => 2, 'text' => 'Interior Renovation', 'votes' => 89, 'percentage' => 32],
            ['id' => 3, 'text' => 'Parking Area', 'votes' => 38, 'percentage' => 14],
            ['id' => 4, 'text' => 'Landscaping', 'votes' => 17, 'percentage' => 6],
        ]],
        ['id' => 7, 'question' => 'Monthly Meeting Time Preference', 'description' => 'What time works best for monthly community meetings? We want to maximize attendance.', 'deadline' => 'Jan 10, 2025', 'status' => 'open', 'votes' => 145, 'category' => 'Community', 'options' => [
            ['id' => 1, 'text' => 'Saturday 2:00 PM', 'votes' => 67, 'percentage' => 46],
            ['id' => 2, 'text' => 'Sunday 2:00 PM', 'votes' => 45, 'percentage' => 31],
            ['id' => 3, 'text' => 'Weekday Evening', 'votes' => 23, 'percentage' => 16],
            ['id' => 4, 'text' => 'Saturday Morning', 'votes' => 10, 'percentage' => 7],
        ]],
        ['id' => 8, 'question' => 'Health Program Topics', 'description' => 'Which health topics should we cover in upcoming seminars? Your input helps us plan better programs.', 'deadline' => 'Dec 18, 2024', 'status' => 'open', 'votes' => 203, 'category' => 'Health', 'options' => [
            ['id' => 1, 'text' => 'Diabetes Prevention', 'votes' => 78, 'percentage' => 38],
            ['id' => 2, 'text' => 'Heart Health', 'votes' => 56, 'percentage' => 28],
            ['id' => 3, 'text' => 'Mental Wellness', 'votes' => 45, 'percentage' => 22],
            ['id' => 4, 'text' => 'Nutrition', 'votes' => 24, 'percentage' => 12],
        ]],
        ['id' => 9, 'question' => 'Street Lighting Improvements', 'description' => 'Which areas need street lighting improvements most urgently? Help us prioritize safety improvements.', 'deadline' => 'Nov 28, 2024', 'status' => 'closed', 'votes' => 189, 'category' => 'Infrastructure', 'options' => [
            ['id' => 1, 'text' => 'Main Street', 'votes' => 89, 'percentage' => 47],
            ['id' => 2, 'text' => 'Residential Areas', 'votes' => 56, 'percentage' => 30],
            ['id' => 3, 'text' => 'Park Area', 'votes' => 34, 'percentage' => 18],
            ['id' => 4, 'text' => 'School Zone', 'votes' => 10, 'percentage' => 5],
        ]],
        ['id' => 10, 'question' => 'Community Library Hours', 'description' => 'What hours should the community library be open? We want to serve the most residents possible.', 'deadline' => 'Jan 15, 2025', 'status' => 'open', 'votes' => 112, 'category' => 'Education', 'options' => [
            ['id' => 1, 'text' => '9 AM - 5 PM Weekdays', 'votes' => 45, 'percentage' => 40],
            ['id' => 2, 'text' => '10 AM - 6 PM Weekdays', 'votes' => 34, 'percentage' => 30],
            ['id' => 3, 'text' => 'Include Weekends', 'votes' => 23, 'percentage' => 21],
            ['id' => 4, 'text' => 'Evening Hours', 'votes' => 10, 'percentage' => 9],
        ]],
        ['id' => 11, 'question' => 'Recycling Program Implementation', 'description' => 'How should we implement the recycling program? Share your ideas and preferences.', 'deadline' => 'Dec 22, 2024', 'status' => 'open', 'votes' => 198, 'category' => 'Environment', 'options' => [
            ['id' => 1, 'text' => 'Weekly Collection', 'votes' => 89, 'percentage' => 45],
            ['id' => 2, 'text' => 'Drop-off Centers', 'votes' => 67, 'percentage' => 34],
            ['id' => 3, 'text' => 'Bi-weekly Collection', 'votes' => 34, 'percentage' => 17],
            ['id' => 4, 'text' => 'Monthly Collection', 'votes' => 8, 'percentage' => 4],
        ]],
        ['id' => 12, 'question' => 'Senior Citizen Activities', 'description' => 'What activities would seniors like to see in the community center? Help us plan engaging programs.', 'deadline' => 'Dec 12, 2024', 'status' => 'closed', 'votes' => 156, 'category' => 'Health', 'options' => [
            ['id' => 1, 'text' => 'Exercise Classes', 'votes' => 67, 'percentage' => 43],
            ['id' => 2, 'text' => 'Arts and Crafts', 'votes' => 45, 'percentage' => 29],
            ['id' => 3, 'text' => 'Social Gatherings', 'votes' => 28, 'percentage' => 18],
            ['id' => 4, 'text' => 'Educational Talks', 'votes' => 16, 'percentage' => 10],
        ]],
    ];
    
    // Find the poll by ID
    $poll = collect($allPolls)->firstWhere('id', (int)$id);
    
    // If poll not found, redirect or show 404
    if (!$poll) {
        abort(404, 'Poll not found');
    }
    
    // Check if user has voted (using localStorage like suggestions)
    $hasVoted = false; // Will be checked via JavaScript
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('polls.index') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-medium">Back to Polls</span>
        </a>
    </div>

    <!-- Poll Details Card -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 lg:p-8">
        <!-- Header -->
        <div class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex items-center gap-2 flex-wrap mb-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                    {{ $poll['category'] }}
                </span>
                @if($poll['status'] === 'open')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-[#65B741]/10 text-[#65B741] border border-[#65B741]/20">
                Open
            </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                        Closed
                    </span>
                @endif
        </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $poll['question'] }}</h1>
            <p class="text-gray-600 text-sm mb-2">{{ $poll['description'] }}</p>
            <div class="flex items-center gap-4 text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $poll['votes'] }} votes</span>
                </div>
                <span>•</span>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Deadline: {{ $poll['deadline'] }}</span>
                </div>
            </div>
        </div>

        <!-- Voting Section -->
        <div id="votingSection" class="mb-6">
            <h3 class="font-semibold text-gray-900 mb-4 text-lg">Cast Your Vote</h3>
            <form id="pollForm" class="space-y-3">
                @foreach($poll['options'] as $option)
                    <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-gray-50 transition-colors poll-option" data-option-id="{{ $option['id'] }}">
                        <input type="radio" name="poll_option" value="{{ $option['id'] }}" class="w-5 h-5 text-gray-900 border-gray-300 focus:ring-gray-900" required>
                        <span class="ml-4 text-gray-900 font-medium flex-1">{{ $option['text'] }}</span>
            </label>
                @endforeach
                <button type="submit" class="w-full mt-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                    Submit Vote
                </button>
            </form>
        </div>

        <!-- Results Section (Hidden initially) -->
        <div id="resultsSection" class="mb-6 hidden">
            <h3 class="font-semibold text-gray-900 mb-4 text-lg">Poll Results</h3>
            <div class="space-y-4">
                @foreach($poll['options'] as $option)
                    <div class="poll-result" data-option-id="{{ $option['id'] }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-900 font-medium">{{ $option['text'] }}</span>
                            <span class="text-gray-600 text-sm font-semibold">{{ $option['votes'] }} votes ({{ $option['percentage'] }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-[#65B741] h-3 rounded-full transition-all duration-500" style="width: {{ $option['percentage'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600 text-center">Total Votes: <span class="font-semibold text-gray-900" id="totalVotes">{{ $poll['votes'] }}</span></p>
            </div>
        </div>

        <!-- Footer -->
        <div class="pt-6 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4 text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm">Deadline: {{ $poll['deadline'] }}</span>
                    </div>
                </div>
                <a href="{{ route('polls.index') }}" class="px-6 py-2.5 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                    View All Polls
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Poll Voting System (using same TemporaryAuth as suggestions - no login required)
class PollVoting {
    constructor() {
        // Use same user ID system as suggestions
        this.userIdKey = 'suggestion_user_id';
        this.pollVotesKey = 'poll_votes';
        this.pollSelectedOptionsKey = 'poll_selected_options';
    }

    getUserId() {
        let userId = localStorage.getItem(this.userIdKey);
        if (!userId) {
            userId = 'temp_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem(this.userIdKey, userId);
        }
        return userId;
    }

    hasVoted(pollId) {
        const votes = this.getPollVotes();
        return votes.includes(pollId.toString());
    }

    recordVote(pollId, optionId) {
        const votes = this.getPollVotes();
        if (!votes.includes(pollId.toString())) {
            votes.push(pollId.toString());
            localStorage.setItem(this.pollVotesKey, JSON.stringify(votes));
            
            // Store the selected option
            const selectedOptions = this.getSelectedOptions();
            selectedOptions[pollId] = optionId;
            localStorage.setItem(this.pollSelectedOptionsKey, JSON.stringify(selectedOptions));
            return true;
        }
        return false;
    }

    getPollVotes() {
        const votes = localStorage.getItem(this.pollVotesKey);
        return votes ? JSON.parse(votes) : [];
    }

    getSelectedOptions() {
        const options = localStorage.getItem(this.pollSelectedOptionsKey);
        return options ? JSON.parse(options) : {};
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const pollVoting = new PollVoting();
    const pollId = {{ $poll['id'] }};
    const pollForm = document.getElementById('pollForm');
    const votingSection = document.getElementById('votingSection');
    const resultsSection = document.getElementById('resultsSection');
    
    // Check if user has already voted
    if (pollVoting.hasVoted(pollId)) {
        // Show results instead of voting form
        votingSection.classList.add('hidden');
        resultsSection.classList.remove('hidden');
        
        // Highlight the user's selected option
        const selectedOptions = pollVoting.getSelectedOptions();
        const selectedOptionId = selectedOptions[pollId];
        if (selectedOptionId) {
            const selectedOptionElement = document.querySelector(`.poll-result[data-option-id="${selectedOptionId}"]`);
            if (selectedOptionElement) {
                selectedOptionElement.classList.add('ring-2', 'ring-[#65B741]', 'ring-offset-2', 'rounded-lg', 'p-2', 'bg-[#65B741]/5');
            }
        }
    }
    
    // Handle form submission (no login required - same as suggestions)
    if (pollForm) {
        pollForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const selectedOption = document.querySelector('input[name="poll_option"]:checked');
            if (!selectedOption) {
                alert('Please select an option');
                return;
            }
            
            const optionId = selectedOption.value;
            
            // Record vote (no login required - uses localStorage like suggestions)
            if (pollVoting.recordVote(pollId, optionId)) {
                // Hide voting form, show results
                votingSection.classList.add('hidden');
                resultsSection.classList.remove('hidden');
                
                // Highlight the selected option
                const selectedOptionElement = document.querySelector(`.poll-result[data-option-id="${optionId}"]`);
                if (selectedOptionElement) {
                    selectedOptionElement.classList.add('ring-2', 'ring-[#65B741]', 'ring-offset-2', 'rounded-lg', 'p-2', 'bg-[#65B741]/5');
                }
                
                // Update vote count (increment by 1)
                const totalVotesEl = document.getElementById('totalVotes');
                if (totalVotesEl) {
                    const currentVotes = parseInt(totalVotesEl.textContent);
                    totalVotesEl.textContent = currentVotes + 1;
                }
                
                alert('Thank you for voting! Your vote has been recorded.');
            } else {
                alert('You have already voted on this poll.');
            }
        });
    }
});
</script>
@endsection
