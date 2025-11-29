@extends('layouts.app')

@section('title', 'Community Suggestions - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4" data-aos="fade-down">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">Community Suggestions</h1>
            <p class="text-text-secondary">Share your ideas to improve our community</p>
        </div>
        <a href="{{ route('suggestions.create') }}" class="btn-primary px-6 py-3 rounded-lg flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>New Suggestion</span>
        </a>
        <div class="text-xs text-text-muted mt-2">* Login required to submit</div>
    </div>

    <!-- Sort Options -->
    <div class="modern-card p-4 mb-6" data-aos="fade-up">
        <div class="flex items-center gap-4">
            <span class="text-sm font-semibold text-text-primary">Sort by:</span>
            <button class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold">Newest</button>
            <button class="px-4 py-2 bg-gray-100 text-text-secondary rounded-lg text-sm font-semibold hover:bg-gray-200">Most Liked</button>
            <button class="px-4 py-2 bg-gray-100 text-text-secondary rounded-lg text-sm font-semibold hover:bg-gray-200">Most Discussed</button>
        </div>
    </div>

    <!-- Suggestions Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $suggestions = [
                ['id' => 1, 'title' => 'Weekly Community Exercise Program', 'category' => 'Health', 'upvotes' => 45, 'comments' => 12, 'author' => 'Maria Santos', 'date' => '3 days ago'],
                ['id' => 2, 'title' => 'Install Solar-Powered Streetlights', 'category' => 'Infrastructure', 'upvotes' => 89, 'comments' => 23, 'author' => 'Anonymous', 'date' => '1 week ago'],
                ['id' => 3, 'title' => 'Monthly Barangay Festival', 'category' => 'Events', 'upvotes' => 156, 'comments' => 34, 'author' => 'Juan Dela Cruz', 'date' => '2 weeks ago'],
                ['id' => 4, 'title' => 'Free Computer Literacy Classes', 'category' => 'Education', 'upvotes' => 67, 'comments' => 15, 'author' => 'Ana Reyes', 'date' => '1 week ago'],
                ['id' => 5, 'title' => 'Community Garden Project', 'category' => 'Environment', 'upvotes' => 112, 'comments' => 28, 'author' => 'Pedro Martinez', 'date' => '5 days ago'],
                ['id' => 6, 'title' => 'Youth Sports Tournament', 'category' => 'Sports', 'upvotes' => 78, 'comments' => 19, 'author' => 'Anonymous', 'date' => '4 days ago'],
            ];
        @endphp

        @foreach($suggestions as $suggestion)
        <div class="modern-card p-6 hover-lift" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="mb-4">
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-green-light-bg text-primary mb-3 inline-block">
                    {{ $suggestion['category'] }}
                </span>
                <h3 class="text-lg font-bold text-text-primary mb-2">{{ $suggestion['title'] }}</h3>
                <div class="flex items-center text-sm text-text-muted mb-4">
                    <span>By {{ $suggestion['author'] }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $suggestion['date'] }}</span>
                </div>
            </div>
            
            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                <div class="flex items-center gap-4">
                    <button class="flex items-center space-x-2 text-primary hover:text-primary-dark">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                        <span class="font-semibold">{{ $suggestion['upvotes'] }}</span>
                    </button>
                    <div class="flex items-center space-x-2 text-text-muted">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <span>{{ $suggestion['comments'] }}</span>
                    </div>
                </div>
                <a href="{{ route('suggestions.show', $suggestion['id']) }}" class="text-primary hover:text-primary-dark font-semibold text-sm">
                    View →
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

