@extends('layouts.app')

@section('title', 'Community Polls - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Community Polls</h1>
            <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Participate in community decisions and voice your opinion</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-10">
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="text-3xl font-bold text-gray-900 mb-1">12</div>
                <div class="text-sm font-medium text-gray-600">Total Polls</div>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="text-3xl font-bold text-[#65B741] mb-1">8</div>
                <div class="text-sm font-medium text-gray-600">Active</div>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="text-3xl font-bold text-[#FFB534] mb-1">1,245</div>
                <div class="text-sm font-medium text-gray-600">Total Votes</div>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                <div class="text-3xl font-bold text-gray-700 mb-1">4</div>
                <div class="text-sm font-medium text-gray-600">Closed</div>
            </div>
        </div>
    </div>

    <!-- Polls Grid -->
    @php
        $allPolls = [
            ['id' => 1, 'question' => 'Preferred Day for Community Market', 'description' => 'Which day works best for a weekly community market? We want to choose a day that works for most residents.', 'deadline' => 'Dec 15, 2024', 'status' => 'open', 'votes' => 234, 'category' => 'Community'],
            ['id' => 2, 'question' => 'Community Garden Location', 'description' => 'Where should we establish the new community garden? Help us decide the best location for everyone.', 'deadline' => 'Dec 20, 2024', 'status' => 'open', 'votes' => 156, 'category' => 'Infrastructure'],
            ['id' => 3, 'question' => 'Festival Theme for New Year', 'description' => 'What theme should we use for the New Year festival? Your input will help shape our celebration.', 'deadline' => 'Nov 30, 2024', 'status' => 'closed', 'votes' => 312, 'category' => 'Events'],
            ['id' => 4, 'question' => 'Garbage Collection Schedule', 'description' => 'Should we change the garbage collection schedule? Current schedule is Monday and Thursday.', 'deadline' => 'Dec 25, 2024', 'status' => 'open', 'votes' => 89, 'category' => 'Service'],
            ['id' => 5, 'question' => 'Youth Sports Program Activities', 'description' => 'Which sports activities should we include in the youth program? Select your top preferences.', 'deadline' => 'Jan 5, 2025', 'status' => 'open', 'votes' => 167, 'category' => 'Sports'],
            ['id' => 6, 'question' => 'Community Center Renovation Priorities', 'description' => 'What should be our priority for the community center renovation? Help us allocate resources wisely.', 'deadline' => 'Dec 10, 2024', 'status' => 'closed', 'votes' => 278, 'category' => 'Infrastructure'],
            ['id' => 7, 'question' => 'Monthly Meeting Time Preference', 'description' => 'What time works best for monthly community meetings? We want to maximize attendance.', 'deadline' => 'Jan 10, 2025', 'status' => 'open', 'votes' => 145, 'category' => 'Community'],
            ['id' => 8, 'question' => 'Health Program Topics', 'description' => 'Which health topics should we cover in upcoming seminars? Your input helps us plan better programs.', 'deadline' => 'Dec 18, 2024', 'status' => 'open', 'votes' => 203, 'category' => 'Health'],
            ['id' => 9, 'question' => 'Street Lighting Improvements', 'description' => 'Which areas need street lighting improvements most urgently? Help us prioritize safety improvements.', 'deadline' => 'Nov 28, 2024', 'status' => 'closed', 'votes' => 189, 'category' => 'Infrastructure'],
            ['id' => 10, 'question' => 'Community Library Hours', 'description' => 'What hours should the community library be open? We want to serve the most residents possible.', 'deadline' => 'Jan 15, 2025', 'status' => 'open', 'votes' => 112, 'category' => 'Education'],
            ['id' => 11, 'question' => 'Recycling Program Implementation', 'description' => 'How should we implement the recycling program? Share your ideas and preferences.', 'deadline' => 'Dec 22, 2024', 'status' => 'open', 'votes' => 198, 'category' => 'Environment'],
            ['id' => 12, 'question' => 'Senior Citizen Activities', 'description' => 'What activities would seniors like to see in the community center? Help us plan engaging programs.', 'deadline' => 'Dec 12, 2024', 'status' => 'closed', 'votes' => 156, 'category' => 'Health'],
        ];

        // Paginate
        $perPage = 6;
        $currentPage = request('page', 1);
        $total = count($allPolls);
        $offset = ($currentPage - 1) * $perPage;
        $polls = array_slice($allPolls, $offset, $perPage);
        
        // Create paginator
        $polls = new \Illuminate\Pagination\LengthAwarePaginator(
            $polls,
            $total,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    @endphp

    @if(count($polls) > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach($polls as $poll)
                <a href="{{ route('polls.show', $poll['id']) }}" class="block group">
                    <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm h-full flex flex-col hover:border-gray-300 hover:shadow-md">
                        <!-- Header -->
                        <div class="mb-4">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-base font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">
                                    {{ $poll['question'] }}
                                </h3>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            
                            <div class="flex items-center gap-2 flex-wrap mb-3">
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
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                                {{ $poll['description'] }}
                            </p>
                        </div>
                        
                        <!-- Footer -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $poll['votes'] }} votes</span>
                                </div>
                                <span>•</span>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $poll['deadline'] }}</span>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 group-hover:text-gray-900">
                                @if($poll['status'] === 'open')
                                    Vote Now →
                                @else
                                    View Results →
                                @endif
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($polls->hasPages())
            <div class="flex justify-center mt-6">
                <div class="flex items-center gap-2">
                    @if($polls->onFirstPage())
                        <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $polls->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Previous</a>
                    @endif

                    @foreach($polls->getUrlRange(1, $polls->lastPage()) as $page => $url)
                        @if($page == $polls->currentPage())
                            <span class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($polls->hasMorePages())
                        <a href="{{ $polls->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</a>
                    @else
                        <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">No polls found.</p>
        </div>
    @endif
</div>
@endsection
