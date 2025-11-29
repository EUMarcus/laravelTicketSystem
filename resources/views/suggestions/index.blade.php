@extends('layouts.app')

@section('title', 'Community Suggestions - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
        <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Community Suggestions</h1>
                <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Share your ideas to improve our community</p>
        </div>
            <a href="{{ route('suggestions.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>New Suggestion</span>
            </a>
        </div>
    </div>

    <!-- Sort Options -->
    <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm mb-6">
        <div class="flex items-center gap-3 flex-wrap">
            <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Sort by:</span>
            <a href="{{ route('suggestions.index', ['sort' => 'newest', 'page' => 1]) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('sort', 'newest') == 'newest' ? 'bg-gray-900 text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400' }}">
                Newest
            </a>
            <a href="{{ route('suggestions.index', ['sort' => 'liked', 'page' => 1]) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('sort') == 'liked' ? 'bg-gray-900 text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400' }}">
                Most Liked
            </a>
            <a href="{{ route('suggestions.index', ['sort' => 'discussed', 'page' => 1]) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('sort') == 'discussed' ? 'bg-gray-900 text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400' }}">
                Most Discussed
            </a>
        </div>
    </div>

    <!-- Section Separator -->
    <div class="mb-8 pt-6 border-t border-gray-200">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Public Suggestions</h2>
        <p class="text-sm text-gray-600">Browse all community suggestions and ideas</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6">
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Suggestions Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

        @if(count($suggestions) > 0)
        @foreach($suggestions as $suggestion)
        <a href="{{ route('suggestions.show', $suggestion['id']) }}" class="block group">
            <div class="bg-white p-5 rounded-lg border border-gray-200 h-full flex flex-col hover:border-gray-300 hover:shadow-md">
                <!-- Header -->
            <div class="mb-4">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-base font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">
                            {{ $suggestion['title'] }}
                        </h3>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    
                    <div class="flex items-center gap-2 flex-wrap mb-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                    {{ $suggestion['category'] }}
                </span>
                    </div>
                    
                    <div class="flex items-center text-xs text-gray-500 mb-4">
                    <span>By {{ $suggestion['author'] }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $suggestion['date'] }}</span>
                </div>
            </div>
            
                <!-- Footer Info -->
                <div class="pt-4 border-t border-gray-100 mt-auto">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4 text-sm">
                            <div class="flex items-center gap-1.5 text-gray-600">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                                <span class="font-semibold text-gray-900">{{ $suggestion['upvotes'] }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-gray-600">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                                <span class="font-semibold text-gray-900">{{ $suggestion['comments'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        @else
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-500 text-lg">No suggestions found.</p>
        </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($suggestions->hasPages())
    <div class="flex justify-center mt-6">
        <div class="flex items-center gap-2">
            @if($suggestions->onFirstPage())
                <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
            @else
                <a href="{{ $suggestions->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Previous</a>
            @endif

            @foreach($suggestions->getUrlRange(1, $suggestions->lastPage()) as $page => $url)
                @if($page == $suggestions->currentPage())
                    <span class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                @endif
        @endforeach

            @if($suggestions->hasMorePages())
                <a href="{{ $suggestions->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</a>
            @else
                <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection

