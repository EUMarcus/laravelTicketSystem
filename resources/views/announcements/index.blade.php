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
                        <span>Create Post</span>
                    </button>
                </div>
            @endif
            
            <!-- Title Section -->
            <div class="text-center">
                   <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">News & Events</h1>
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


    @if(count($announcements) > 0)
        <!-- Announcements Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        @foreach($announcements as $announcement)
        <a href="{{ route('announcements.show', $announcement['id']) }}" class="block group">
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm h-full flex flex-col hover:border-gray-300 hover:shadow-md transition-all">
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
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Urgent
                            </span>
                        @endif
                    </div>
                    
                    <!-- Summary/Content -->
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed flex-grow">
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

<!-- Create Announcement Modal -->
@if(session('user') && session('user')['role'] === 'employee')
<div id="announcementModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative z-10">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Create New Post</h2>
                <button type="button" onclick="closeAnnouncementModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
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

                <!-- Start Date (for Events) -->
                <div>
                    <label for="start_date" class="block text-sm font-semibold text-gray-900 mb-2">
                        Start Date & Time <span class="text-gray-400 font-normal">(Optional - for events)</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        id="start_date" 
                        name="start_date" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-[#65B741] outline-none"
                    >
                </div>

                <!-- End Date (for Events) -->
                <div>
                    <label for="end_date" class="block text-sm font-semibold text-gray-900 mb-2">
                        End Date & Time <span class="text-gray-400 font-normal">(Optional - for events)</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        id="end_date" 
                        name="end_date" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-[#65B741] outline-none"
                    >
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
                        Publish Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAnnouncementModal() {
    const modal = document.getElementById('announcementModal');
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    modal.style.backgroundColor = 'rgba(0, 0, 0, 0.75)';
    modal.style.backdropFilter = 'blur(4px)';
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.right = '0';
    modal.style.bottom = '0';
    modal.style.zIndex = '9999';
    document.body.style.overflow = 'hidden';
}

function closeAnnouncementModal() {
    const modal = document.getElementById('announcementModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        // Reset form
        const form = document.getElementById('announcementForm');
        if (form) {
            form.reset();
        }
    }
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('announcementModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeAnnouncementModal();
            }
        });
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('announcementModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeAnnouncementModal();
        }
    }
});
</script>
@endif
@endsection
