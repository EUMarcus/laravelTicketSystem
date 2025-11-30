@extends('layouts.app')

@section('title', 'Announcements - Staff Dashboard')

@section('content')
@if(session('user') && in_array(session('user')['role'] ?? '', ['employee', 'admin']))
<div class="flex min-h-screen" style="padding-top: 4rem;">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 fixed left-0 top-16 h-[calc(100vh-4rem)] overflow-y-auto z-40">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Staff Dashboard</h2>
            
            <nav class="space-y-2">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.dashboard') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Overview</span>
                </a>
                
                <div class="pt-4">
                    <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Manage</h3>
                    
                    <a href="{{ route('staff.reports') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.reports') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="font-medium">Reports</span>
                    </a>
                    
                    <a href="{{ route('staff.suggestions') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.suggestions') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <span class="font-medium">Suggestions</span>
                    </a>
                    
                    <a href="{{ route('staff.announcements') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.announcements') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                        <span class="font-medium">News & Events</span>
                    </a>
                    
                </div>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 min-h-screen" style="margin-top: -4rem !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-0 pb-8">
        <!-- Header -->
        <div class="mb-10">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">News & Events</h1>
                    <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                    <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Stay informed with the latest community updates and important notices</p>
                </div>
                <button onclick="openAnnouncementModal()" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Create Post</span>
                </button>
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

        @if(count($announcements) > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach($announcements as $announcement)
            <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm h-full flex flex-col hover:border-gray-300 hover:shadow-md">
                            <!-- Header -->
                    <div class="mb-4">
                                <div class="flex items-start justify-between mb-3">
                                    <a href="{{ route('announcements.show', $announcement['id']) }}" class="flex-1 group">
                                        <h3 class="text-base font-bold text-gray-900 line-clamp-2 group-hover:text-gray-700">
                                            {{ $announcement['title'] }}
                                        </h3>
                                    </a>
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
                            <div class="pt-4 border-t border-gray-100 mt-auto">
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                    <div class="flex items-center">
                                        <svg class="w-3.5 h-3.5 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $announcement['date'] }}</span>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('announcements.show', $announcement['id']) }}" class="flex-1 px-3 py-2 text-xs font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-center">
                                        View
                                    </a>
                                    <a href="{{ route('announcements.edit', $announcement['id']) }}" class="flex-1 px-3 py-2 text-xs font-medium text-blue-700 bg-blue-50 rounded-lg hover:bg-blue-100 text-center">
                                        Edit
                                    </a>
                                    <form action="{{ route('announcements.destroy', $announcement['id']) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-3 py-2 text-xs font-medium text-red-700 bg-red-50 rounded-lg hover:bg-red-100">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
</main>
</div>

<!-- Create Announcement Modal -->
<div id="announcementModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto relative mx-auto my-auto z-10" style="max-width: 42rem; margin: auto;">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Create New Post</h2>
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
@else
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-8 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Access Denied</h2>
        <p class="text-gray-600 mb-6">You need to be logged in as staff to access this page.</p>
        <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-[#65B741] text-white font-semibold rounded-lg hover:bg-[#4d8a32]">
            Go to Login
        </a>
    </div>
</div>
@endif
@endsection

