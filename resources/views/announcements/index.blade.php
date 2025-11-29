@extends('layouts.app')

@section('title', 'Announcements - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Announcements</h1>
            <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Stay informed with the latest community updates and important notices</p>
        </div>
    </div>

    <!-- Announcements Grid -->
        @php
        $allAnnouncements = [
            ['id' => 1, 'title' => 'Community Clean-Up Day Scheduled', 'category' => 'Event', 'date' => 'Dec 5, 2024', 'summary' => 'Join us for a community-wide clean-up activity this coming Saturday. All residents are welcome to participate.', 'urgent' => false],
            ['id' => 2, 'title' => 'Health Advisory: Dengue Prevention', 'category' => 'Health', 'date' => 'Dec 3, 2024', 'summary' => 'Important reminders on preventing dengue. Keep your surroundings clean and eliminate stagnant water.', 'urgent' => true],
            ['id' => 3, 'title' => 'Barangay Meeting This Saturday', 'category' => 'Meeting', 'date' => 'Dec 1, 2024', 'summary' => 'Monthly barangay meeting scheduled. All residents are encouraged to attend and voice their concerns.', 'urgent' => false],
            ['id' => 4, 'title' => 'Free Medical Check-Up Available', 'category' => 'Health', 'date' => 'Nov 28, 2024', 'summary' => 'Free health screening for all community members. Blood pressure, BMI, and basic check-ups available.', 'urgent' => false],
            ['id' => 5, 'title' => 'New Year Festival Preparations', 'category' => 'Event', 'date' => 'Nov 25, 2024', 'summary' => 'Planning for the New Year community festival has started. Volunteers needed for organizing committee.', 'urgent' => false],
            ['id' => 6, 'title' => 'Water Interruption Notice', 'category' => 'Service', 'date' => 'Nov 22, 2024', 'summary' => 'Water service will be interrupted on December 10 for pipe maintenance. Please store water.', 'urgent' => true],
            ['id' => 7, 'title' => 'Road Repair Schedule', 'category' => 'Infrastructure', 'date' => 'Nov 20, 2024', 'summary' => 'Main street will undergo repairs from December 15-20. Alternative routes will be provided.', 'urgent' => false],
            ['id' => 8, 'title' => 'Holiday Safety Reminders', 'category' => 'Safety', 'date' => 'Nov 18, 2024', 'summary' => 'Important safety tips for the holiday season. Keep your homes secure and report suspicious activities.', 'urgent' => false],
            ['id' => 9, 'title' => 'Scholarship Program Applications', 'category' => 'Education', 'date' => 'Nov 15, 2024', 'summary' => 'Applications for community scholarship program are now open. Deadline: December 30, 2024.', 'urgent' => false],
            ['id' => 10, 'title' => 'Garbage Collection Schedule Change', 'category' => 'Service', 'date' => 'Nov 12, 2024', 'summary' => 'Garbage collection will be moved to Tuesday and Friday starting next week.', 'urgent' => false],
            ['id' => 11, 'title' => 'Community Garden Opening', 'category' => 'Event', 'date' => 'Nov 10, 2024', 'summary' => 'Our new community garden is now open! Residents can register for their own plot.', 'urgent' => false],
            ['id' => 12, 'title' => 'Emergency Contact Numbers', 'category' => 'Safety', 'date' => 'Nov 8, 2024', 'summary' => 'Updated emergency contact numbers for barangay office, police, and fire department.', 'urgent' => true],
            ];

        // Paginate
        $perPage = 6;
        $currentPage = request('page', 1);
        $total = count($allAnnouncements);
        $offset = ($currentPage - 1) * $perPage;
        $announcements = array_slice($allAnnouncements, $offset, $perPage);
        
        // Create paginator
        $announcements = new \Illuminate\Pagination\LengthAwarePaginator(
            $announcements,
            $total,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        @endphp

    @if(count($announcements) > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        @foreach($announcements as $announcement)
        <a href="{{ route('announcements.show', $announcement['id']) }}" class="block group">
                    <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm h-full flex flex-col hover:border-gray-300 hover:shadow-md">
                        <!-- Header -->
                <div class="mb-4">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-base font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">
                                    {{ $announcement['title'] }}
                                </h3>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            
                            <div class="flex items-center gap-2 flex-wrap mb-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                        {{ $announcement['category'] }}
                    </span>
                                @if($announcement['urgent'])
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                        Urgent
                                    </span>
                                @endif
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                        {{ $announcement['summary'] }}
                    </p>
                </div>
                        
                        <!-- Footer -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-3.5 h-3.5 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $announcement['date'] }}</span>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 group-hover:text-gray-900">Read More →</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

        <!-- Pagination -->
        @if($announcements->hasPages())
            <div class="flex justify-center mt-6">
                <div class="flex items-center gap-2">
                    @if($announcements->onFirstPage())
                        <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $announcements->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Previous</a>
                    @endif

                    @foreach($announcements->getUrlRange(1, $announcements->lastPage()) as $page => $url)
                        @if($page == $announcements->currentPage())
                            <span class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($announcements->hasMorePages())
                        <a href="{{ $announcements->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</a>
                    @else
                        <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">No announcements found.</p>
        </div>
    @endif
</div>
@endsection
