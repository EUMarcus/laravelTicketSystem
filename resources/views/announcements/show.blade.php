@extends('layouts.app')

@section('title', 'Announcement Details - Community Hub')

@section('content')
@php
    // Same dataset as index page
    $allAnnouncements = [
        ['id' => 1, 'title' => 'Community Clean-Up Day Scheduled', 'category' => 'Event', 'date' => 'Dec 5, 2024', 'summary' => 'Join us for a community-wide clean-up activity this coming Saturday. All residents are welcome to participate.', 'urgent' => false, 'content' => 'We are excited to announce our upcoming Community Clean-Up Day scheduled for Saturday, December 14, 2024, from 8:00 AM to 12:00 PM. This is a community-wide initiative to clean and beautify our barangay. All residents are warmly invited to participate in this activity. Together, we can make our community a cleaner and more beautiful place to live. What to bring: Gloves and protective gear, Garbage bags, Your enthusiasm and positive energy! Light refreshments will be provided. For more information, please contact the barangay office.', 'images' => ['https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800', 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800', 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800']],
        ['id' => 2, 'title' => 'Health Advisory: Dengue Prevention', 'category' => 'Health', 'date' => 'Dec 3, 2024', 'summary' => 'Important reminders on preventing dengue. Keep your surroundings clean and eliminate stagnant water.', 'urgent' => true, 'content' => 'With the rainy season upon us, we need to be extra vigilant about dengue prevention. Please follow these important guidelines: 1. Eliminate all sources of stagnant water around your homes. 2. Clean and cover water containers regularly. 3. Use mosquito repellent and wear protective clothing. 4. Keep your surroundings clean and well-maintained. If you experience symptoms like high fever, severe headache, or body pain, seek medical attention immediately.', 'images' => ['https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800', 'https://images.unsplash.com/photo-1584464491033-06628f3a6b7b?w=800', 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800', 'https://images.unsplash.com/photo-1607613009820-a29f1a45b2a0?w=800']],
        ['id' => 3, 'title' => 'Barangay Meeting This Saturday', 'category' => 'Meeting', 'date' => 'Dec 1, 2024', 'summary' => 'Monthly barangay meeting scheduled. All residents are encouraged to attend and voice their concerns.', 'urgent' => false, 'content' => 'Our monthly barangay meeting will be held this Saturday, December 7, 2024, at 2:00 PM in the barangay hall. All residents are encouraged to attend and participate in the discussion. Agenda items include: Community projects update, Budget allocation for next quarter, Safety and security concerns, Upcoming events and activities. Your voice matters! Please come and share your ideas and concerns.', 'images' => ['https://images.unsplash.com/photo-1552664730-d307ca884978?w=800', 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800']],
        ['id' => 4, 'title' => 'Free Medical Check-Up Available', 'category' => 'Health', 'date' => 'Nov 28, 2024', 'summary' => 'Free health screening for all community members. Blood pressure, BMI, and basic check-ups available.', 'urgent' => false, 'content' => 'We are pleased to announce free medical check-ups for all community members. Services include: Blood pressure monitoring, BMI calculation, Basic health consultation, Health education. The check-ups will be available every Tuesday and Thursday from 9:00 AM to 3:00 PM at the barangay health center. No appointment needed. First come, first served.', 'images' => ['https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800', 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=800', 'https://images.unsplash.com/photo-1512678080530-7d7d8b1e0b0e?w=800']],
        ['id' => 5, 'title' => 'New Year Festival Preparations', 'category' => 'Event', 'date' => 'Nov 25, 2024', 'summary' => 'Planning for the New Year community festival has started. Volunteers needed for organizing committee.', 'urgent' => false, 'content' => 'Planning for our annual New Year community festival has officially begun! We are looking for enthusiastic volunteers to join our organizing committee. Volunteer opportunities include: Event planning and coordination, Food and beverage committee, Entertainment and activities, Decorations and setup, Security and safety. If you are interested in volunteering, please contact the barangay office or attend our planning meeting this Friday at 6:00 PM.', 'images' => ['https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800', 'https://images.unsplash.com/photo-1478147427282-58a87a120781?w=800', 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=800', 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800']],
        ['id' => 6, 'title' => 'Water Interruption Notice', 'category' => 'Service', 'date' => 'Nov 22, 2024', 'summary' => 'Water service will be interrupted on December 10 for pipe maintenance. Please store water.', 'urgent' => true, 'content' => 'Important Notice: Water service will be temporarily interrupted on December 10, 2024, from 8:00 AM to 4:00 PM for scheduled pipe maintenance and repairs. Affected areas: Main Street, Park Avenue, and surrounding blocks. Please store enough water for your household needs during this period. Water tankers will be available at the barangay hall for emergency water supply. We apologize for any inconvenience and appreciate your understanding.', 'images' => ['https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800']],
        ['id' => 7, 'title' => 'Road Repair Schedule', 'category' => 'Infrastructure', 'date' => 'Nov 20, 2024', 'summary' => 'Main street will undergo repairs from December 15-20. Alternative routes will be provided.', 'urgent' => false, 'content' => 'Main Street will undergo road repairs from December 15-20, 2024. During this period, the road will be partially closed. Alternative routes: Use Park Avenue or Community Road. Please plan your travel accordingly and expect minor delays. We appreciate your patience as we work to improve our infrastructure.', 'images' => ['https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800', 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800']],
        ['id' => 8, 'title' => 'Holiday Safety Reminders', 'category' => 'Safety', 'date' => 'Nov 18, 2024', 'summary' => 'Important safety tips for the holiday season. Keep your homes secure and report suspicious activities.', 'urgent' => false, 'content' => 'As we approach the holiday season, please keep these safety reminders in mind: Secure your homes when leaving, Do not leave valuables in plain sight, Report suspicious activities immediately, Be cautious with fire hazards (candles, decorations), Keep emergency numbers handy. Let us work together to ensure a safe and happy holiday season for everyone.', 'images' => ['https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800']],
        ['id' => 9, 'title' => 'Scholarship Program Applications', 'category' => 'Education', 'date' => 'Nov 15, 2024', 'summary' => 'Applications for community scholarship program are now open. Deadline: December 30, 2024.', 'urgent' => false, 'content' => 'The barangay scholarship program is now accepting applications for the academic year 2025-2026. Eligibility: Residents aged 16-25, High school graduates or current college students, Family income below specified threshold. Required documents: Application form, Transcript of records, Certificate of residency, Income tax return or certificate of indigency. Application deadline: December 30, 2024. Forms available at the barangay office.', 'images' => ['https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800', 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800']],
        ['id' => 10, 'title' => 'Garbage Collection Schedule Change', 'category' => 'Service', 'date' => 'Nov 12, 2024', 'summary' => 'Garbage collection will be moved to Tuesday and Friday starting next week.', 'urgent' => false, 'content' => 'Starting next week, garbage collection schedule will change to Tuesday and Friday (previously Monday and Thursday). Please adjust your schedule accordingly. Collection time remains the same: 6:00 AM to 12:00 PM. Please have your garbage ready and properly segregated.', 'images' => ['https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=800']],
        ['id' => 11, 'title' => 'Community Garden Opening', 'category' => 'Event', 'date' => 'Nov 10, 2024', 'summary' => 'Our new community garden is now open! Residents can register for their own plot.', 'urgent' => false, 'content' => 'Our new community garden is now officially open! Residents can register for their own gardening plot. Each plot measures 2x3 meters. Registration fee: P100 per month. Benefits: Fresh vegetables for your family, Community bonding, Environmental awareness. Registration is open at the barangay office. Limited slots available!', 'images' => ['https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800', 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800', 'https://images.unsplash.com/photo-1593113598332-cd288d649433?w=800']],
        ['id' => 12, 'title' => 'Emergency Contact Numbers', 'category' => 'Safety', 'date' => 'Nov 8, 2024', 'summary' => 'Updated emergency contact numbers for barangay office, police, and fire department.', 'urgent' => true, 'content' => 'Please save these updated emergency contact numbers: Barangay Office: 123-4567, Police Station: 911, Fire Department: 117, Hospital: 123-7890, Emergency Hotline: 8888. Keep these numbers handy and share with family members. In case of emergency, call immediately.', 'images' => ['https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800']],
    ];
    
    // Merge session announcements with hardcoded ones
    $sessionAnnouncements = session('announcements', []);
    $allAnnouncements = array_merge($sessionAnnouncements, $allAnnouncements);
    
    // Find the announcement by ID
    $announcement = collect($allAnnouncements)->firstWhere('id', (int)$id);
    
    // If announcement not found, redirect or show 404
    if (!$announcement) {
        abort(404, 'Announcement not found');
    }
@endphp

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
