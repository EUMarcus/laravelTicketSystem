@extends('layouts.app')

@section('title', 'Announcements - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="mb-8">
            <!-- Button Row (if staff) -->
            @if(session('user') && session('user')['role'] === 'employee')
                <div class="flex justify-end mb-6">
                    <button onclick="openAnnouncementModal()" class="inline-flex items-center gap-2 px-6 py-3 bg-[#65B741] text-white font-semibold rounded-lg hover:bg-[#4d8a32] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>New Announcement</span>
                    </button>
                </div>
            @endif
            
            <!-- Title Section -->
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Announcements</h1>
                <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4 mx-auto"></div>
                <p class="text-lg md:text-xl text-gray-600">Stay informed with the latest community updates and important notices</p>
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

    <!-- Announcements Grid -->
        @php
        $hardcodedAnnouncements = [
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
        
        // Merge session announcements with hardcoded ones (session announcements first)
        $sessionAnnouncements = session('announcements', []);
        $allAnnouncements = array_merge($sessionAnnouncements, $hardcodedAnnouncements);

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
        <!-- Newsfeed Layout -->
        <div class="space-y-6 mb-6">
        @foreach($announcements as $announcement)
        <a href="{{ route('announcements.show', $announcement['id']) }}" class="block group">
            <article class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md hover:border-gray-300 transition-all duration-200">
                <div class="p-6">
                    <!-- Header with Date and Category -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                                    {{ $announcement['category'] }}
                                </span>
                                @if($announcement['urgent'])
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        Urgent
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $announcement['date'] }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Title -->
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 group-hover:text-[#65B741] transition-colors">
                        {{ $announcement['title'] }}
                    </h2>
                    
                    <!-- Summary/Content -->
                    <p class="text-gray-600 text-base leading-relaxed mb-4">
                        {{ $announcement['summary'] }}
                    </p>
                    
                    <!-- Read More Link -->
                    <div class="flex items-center text-sm font-semibold text-[#65B741] group-hover:text-[#4d8a32] transition-colors">
                        <span>Read more</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </article>
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

<!-- Create Announcement Modal -->
@if(session('user') && session('user')['role'] === 'employee')
<div id="announcementModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4" style="background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(2px);">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Create New Announcement</h2>
                <button onclick="closeAnnouncementModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="announcementForm" method="POST" action="{{ route('announcements.store') }}" class="space-y-6">
                @csrf
                
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-[#65B741] outline-none"
                        placeholder="Enter announcement title"
                    >
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-900 mb-2">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="category" 
                        name="category" 
                        required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-[#65B741] outline-none"
                    >
                        <option value="">Select a category</option>
                        <option value="Event">Event</option>
                        <option value="Health">Health</option>
                        <option value="Meeting">Meeting</option>
                        <option value="Service">Service</option>
                        <option value="Infrastructure">Infrastructure</option>
                        <option value="Safety">Safety</option>
                        <option value="Education">Education</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- Summary -->
                <div>
                    <label for="summary" class="block text-sm font-semibold text-gray-900 mb-2">
                        Summary <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="summary" 
                        name="summary" 
                        rows="3"
                        required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-[#65B741] outline-none resize-none"
                        placeholder="Brief summary of the announcement"
                    ></textarea>
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-900 mb-2">
                        Full Content <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="content" 
                        name="content" 
                        rows="6"
                        required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-[#65B741] outline-none resize-none"
                        placeholder="Enter the full announcement content"
                    ></textarea>
                </div>

                <!-- Urgent Checkbox -->
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="urgent" 
                        name="urgent" 
                        value="1"
                        class="w-4 h-4 text-[#65B741] border-gray-300 rounded focus:ring-[#65B741]"
                    >
                    <label for="urgent" class="ml-2 text-sm font-medium text-gray-700">
                        Mark as Urgent
                    </label>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                    <button 
                        type="button"
                        onclick="closeAnnouncementModal()" 
                        class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit"
                        class="px-6 py-2.5 bg-[#65B741] text-white font-semibold rounded-lg hover:bg-[#4d8a32] transition-colors"
                    >
                        Publish Announcement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAnnouncementModal() {
    document.getElementById('announcementModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeAnnouncementModal() {
    document.getElementById('announcementModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    // Reset form
    document.getElementById('announcementForm').reset();
}

// Close modal when clicking outside
document.getElementById('announcementModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAnnouncementModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('announcementModal');
        if (!modal.classList.contains('hidden')) {
            closeAnnouncementModal();
        }
    }
});
</script>
@endif
@endsection
