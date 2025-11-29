@extends('layouts.app')

@section('title', 'Announcement Details - Community Hub')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('announcements.index') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-medium">Back to Announcements</span>
        </a>
    </div>

    <!-- Announcement Details Card -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 lg:p-8">
        <!-- Header -->
        <div class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex items-center gap-2 flex-wrap mb-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                    {{ $announcement['category'] }}
                </span>
                @if($announcement['urgent'])
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                        Urgent
                    </span>
                @endif
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $announcement['title'] }}</h1>
            <p class="text-gray-600 text-sm">Published {{ $announcement['date'] }}</p>
        </div>

        <!-- Content -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-900 mb-3 text-lg">Details</h3>
            <div class="text-gray-700 leading-relaxed whitespace-pre-line mb-6">{{ $announcement['content'] }}</div>
        </div>

        <!-- Image Gallery -->
        @if(isset($announcement['images']) && count($announcement['images']) > 0)
            <div class="mb-6 pb-6 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4 text-lg">Gallery</h3>
                @if(count($announcement['images']) == 1)
                    <!-- Single Image -->
                    <div class="rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ $announcement['images'][0] }}" alt="{{ $announcement['title'] }}" class="w-full h-auto object-cover cursor-pointer hover:opacity-90 transition-opacity" onclick="openImageModal('{{ $announcement['images'][0] }}')">
                    </div>
                @elseif(count($announcement['images']) == 2)
                    <!-- Two Images -->
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($announcement['images'] as $index => $image)
                            <div class="rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ $image }}" alt="{{ $announcement['title'] }} - Image {{ $index + 1 }}" class="w-full h-64 object-cover cursor-pointer hover:opacity-90 transition-opacity" onclick="openImageModal('{{ $image }}', {{ json_encode($announcement['images']) }}, {{ $index }})">
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Multiple Images - First large, rest in grid -->
                    <div class="space-y-4">
                        <div class="rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ $announcement['images'][0] }}" alt="{{ $announcement['title'] }} - Main Image" class="w-full h-96 object-cover cursor-pointer hover:opacity-90 transition-opacity" onclick="openImageModal('{{ $announcement['images'][0] }}', {{ json_encode($announcement['images']) }}, 0)">
                        </div>
                        @if(count($announcement['images']) > 1)
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach(array_slice($announcement['images'], 1) as $index => $image)
                                    <div class="rounded-lg overflow-hidden border border-gray-200">
                                        <img src="{{ $image }}" alt="{{ $announcement['title'] }} - Image {{ $index + 2 }}" class="w-full h-48 object-cover cursor-pointer hover:opacity-90 transition-opacity" onclick="openImageModal('{{ $image }}', {{ json_encode($announcement['images']) }}, {{ $index + 1 }})">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @endif

        <!-- Footer -->
        <div class="pt-6 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-gray-600">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm">{{ $announcement['date'] }}</span>
                </div>
                <a href="{{ route('announcements.index') }}" class="px-6 py-2.5 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                    View All Announcements
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-[9999] hidden bg-black bg-opacity-90" style="z-index: 9999 !important;">
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="relative max-w-7xl w-full h-full flex items-center justify-center">
            <!-- Close Button -->
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <!-- Previous Button -->
            <button id="prevBtn" onclick="changeImage(-1)" class="absolute left-4 text-white hover:text-gray-300 z-10 bg-black bg-opacity-50 rounded-full p-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            
            <!-- Next Button -->
            <button id="nextBtn" onclick="changeImage(1)" class="absolute right-4 text-white hover:text-gray-300 z-10 bg-black bg-opacity-50 rounded-full p-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            
            <!-- Image -->
            <img id="modalImage" src="" alt="Gallery Image" class="max-w-full max-h-full object-contain">
            
            <!-- Image Counter -->
            <div id="imageCounter" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white bg-black bg-opacity-50 px-4 py-2 rounded-lg text-sm"></div>
        </div>
    </div>
</div>

<script>
let currentImages = [];
let currentImageIndex = 0;

function openImageModal(imageSrc, images = null, index = 0) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const imageCounter = document.getElementById('imageCounter');
    
    if (images && images.length > 0) {
        currentImages = images;
        currentImageIndex = index;
        modalImage.src = images[index];
        
        // Show/hide navigation buttons
        if (images.length > 1) {
            prevBtn.style.display = 'block';
            nextBtn.style.display = 'block';
            imageCounter.textContent = `${index + 1} / ${images.length}`;
            imageCounter.style.display = 'block';
        } else {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
            imageCounter.style.display = 'none';
        }
    } else {
        currentImages = [imageSrc];
        currentImageIndex = 0;
        modalImage.src = imageSrc;
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
        imageCounter.style.display = 'none';
    }
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function changeImage(direction) {
    if (currentImages.length <= 1) return;
    
    currentImageIndex += direction;
    
    if (currentImageIndex < 0) {
        currentImageIndex = currentImages.length - 1;
    } else if (currentImageIndex >= currentImages.length) {
        currentImageIndex = 0;
    }
    
    document.getElementById('modalImage').src = currentImages[currentImageIndex];
    document.getElementById('imageCounter').textContent = `${currentImageIndex + 1} / ${currentImages.length}`;
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageModal');
    if (modal.classList.contains('hidden')) return;
    
    if (e.key === 'Escape') {
        closeImageModal();
    } else if (e.key === 'ArrowLeft') {
        changeImage(-1);
    } else if (e.key === 'ArrowRight') {
        changeImage(1);
    }
});

// Close on background click
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});
</script>
@endsection
