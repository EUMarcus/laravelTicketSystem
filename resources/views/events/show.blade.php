@extends('layouts.app')

@section('title', 'Event Details - Community Hub')

@section('content')
@php
    // Same dataset as index page
    $allEvents = [
        ['id' => 1, 'title' => 'Community Clean-Up Day', 'date' => 'Dec 14, 2024', 'time' => '8:00 AM - 12:00 PM', 'location' => 'Community Park', 'category' => 'Community', 'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800', 'description' => 'Join us for a community-wide clean-up activity to beautify our barangay. All residents are welcome to participate in this initiative. Together, we can make our community a cleaner and more beautiful place to live. What to bring: Gloves, garbage bags, and your enthusiasm! Light refreshments will be provided. For more information, please contact the barangay office.', 'images' => ['https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800', 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800', 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800']],
        ['id' => 2, 'title' => 'Free Health Check-Up', 'date' => 'Dec 21, 2024', 'time' => '9:00 AM - 3:00 PM', 'location' => 'Community Center', 'category' => 'Health', 'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800', 'description' => 'Free health screening for all community members. Services include: Blood pressure monitoring, BMI calculation, Basic health consultation, Health education. The check-ups will be available from 9:00 AM to 3:00 PM at the community center. No appointment needed. First come, first served.', 'images' => ['https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800', 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=800']],
        ['id' => 3, 'title' => 'New Year Community Festival', 'date' => 'Jan 1, 2025', 'time' => '5:00 PM - 12:00 AM', 'location' => 'Main Square', 'category' => 'Celebration', 'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800', 'description' => 'Join us for our annual New Year Community Festival! Celebrate the new year with your neighbors and friends. The festival will feature: Live music and entertainment, Food stalls and local vendors, Fireworks display at midnight, Games and activities for all ages. Don\'t miss this exciting community celebration!', 'images' => ['https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800', 'https://images.unsplash.com/photo-1478147427282-58a87a120781?w=800', 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=800', 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800']],
        ['id' => 4, 'title' => 'Digital Literacy Workshop', 'date' => 'Jan 5, 2025', 'time' => '10:00 AM - 2:00 PM', 'location' => 'Computer Lab', 'category' => 'Workshop', 'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800', 'description' => 'Learn essential digital skills in this free workshop. Topics covered: Basic computer operations, Internet browsing and safety, Email and communication, Social media basics, Online banking and shopping. Perfect for beginners and seniors. Limited seats available. Registration required.', 'images' => ['https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800']],
        ['id' => 5, 'title' => 'Basketball Tournament', 'date' => 'Jan 12, 2025', 'time' => '8:00 AM - 6:00 PM', 'location' => 'Sports Complex', 'category' => 'Sports', 'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800', 'description' => 'Annual community basketball tournament. Open to all residents aged 16 and above. Teams of 5 players. Registration fee: P500 per team. Prizes for top 3 teams. Registration deadline: January 5, 2025. Contact the barangay office to register your team.', 'images' => ['https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800', 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=800']],
        ['id' => 6, 'title' => 'Monthly Community Meeting', 'date' => 'Dec 10, 2024', 'time' => '6:00 PM - 8:00 PM', 'location' => 'Community Hall', 'category' => 'Meeting', 'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800', 'description' => 'Monthly barangay meeting. All residents are encouraged to attend and participate in the discussion. Agenda items include: Community projects update, Budget allocation for next quarter, Safety and security concerns, Upcoming events and activities. Your voice matters!', 'images' => ['https://images.unsplash.com/photo-1552664730-d307ca884978?w=800']],
        ['id' => 7, 'title' => 'Youth Sports Day', 'date' => 'Jan 15, 2025', 'time' => '9:00 AM - 4:00 PM', 'location' => 'Sports Complex', 'category' => 'Sports', 'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800', 'description' => 'A fun-filled day of sports activities for youth aged 10-18. Activities include: Basketball, Volleyball, Badminton, Track and field events. Free registration. Trophies and medals for winners. Refreshments provided.', 'images' => ['https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800', 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=800', 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800']],
        ['id' => 8, 'title' => 'Cooking Class for Seniors', 'date' => 'Jan 8, 2025', 'time' => '2:00 PM - 4:00 PM', 'location' => 'Community Kitchen', 'category' => 'Workshop', 'image' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800', 'description' => 'Learn healthy and easy recipes designed for seniors. Class includes: Recipe demonstrations, Hands-on cooking experience, Nutrition tips, Recipe handouts. Free for senior citizens. Limited to 20 participants. Registration required.', 'images' => ['https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800', 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800']],
        ['id' => 9, 'title' => 'Art & Craft Fair', 'date' => 'Jan 20, 2025', 'time' => '10:00 AM - 6:00 PM', 'location' => 'Community Center', 'category' => 'Community', 'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800', 'description' => 'Showcase your artistic talents! Local artists and crafters are invited to display and sell their work. Visitors can browse unique handmade items, watch live demonstrations, and participate in craft workshops. Vendor registration: P200 per booth. Contact us to reserve your space.', 'images' => ['https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800', 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=800']],
        ['id' => 10, 'title' => 'Blood Donation Drive', 'date' => 'Dec 18, 2024', 'time' => '8:00 AM - 2:00 PM', 'location' => 'Community Center', 'category' => 'Health', 'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800', 'description' => 'Help save lives by donating blood. Open to healthy individuals aged 18-65. Requirements: Valid ID, Good health, No recent illnesses. Light refreshments will be provided. Walk-ins welcome, but appointments preferred. Call to schedule your donation time.', 'images' => ['https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800']],
        ['id' => 11, 'title' => 'Christmas Caroling', 'date' => 'Dec 24, 2024', 'time' => '6:00 PM - 9:00 PM', 'location' => 'Main Square', 'category' => 'Celebration', 'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800', 'description' => 'Join us for a festive evening of Christmas caroling around the community. We\'ll visit different areas and spread holiday cheer. All are welcome to join the caroling group or simply enjoy the music. Hot chocolate and cookies will be served. Bring your family and friends!', 'images' => ['https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800', 'https://images.unsplash.com/photo-1482517967863-00e15c9b44be?w=800']],
        ['id' => 12, 'title' => 'Environmental Awareness Seminar', 'date' => 'Jan 25, 2025', 'time' => '1:00 PM - 3:00 PM', 'location' => 'Community Hall', 'category' => 'Workshop', 'image' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800', 'description' => 'Learn about environmental conservation and sustainable living practices. Topics include: Waste reduction and recycling, Water conservation, Energy efficiency, Climate change awareness. Free admission. All residents welcome. Certificates will be provided to attendees.', 'images' => ['https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800', 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800']],
    ];
    
    // Find the event by ID
    $event = collect($allEvents)->firstWhere('id', (int)$id);
    
    // If event not found, redirect or show 404
    if (!$event) {
        abort(404, 'Event not found');
    }
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('events.index') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-medium">Back to Events</span>
        </a>
    </div>

    <!-- Event Details Card -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 lg:p-8">
        <!-- Header -->
        <div class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex items-center gap-2 flex-wrap mb-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                    {{ $event['category'] }}
                </span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $event['title'] }}</h1>
        </div>

        <!-- Main Image -->
        @if(isset($event['image']))
            <div class="mb-6">
                <div class="rounded-lg overflow-hidden border border-gray-200">
                    <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-96 object-cover">
                </div>
            </div>
        @endif

        <!-- Event Details Grid -->
        <div class="grid md:grid-cols-2 gap-6 mb-6 pb-6 border-b border-gray-200">
            <div>
                <h3 class="font-semibold text-gray-900 mb-3 text-lg">Date & Time</h3>
                <div class="space-y-2">
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">{{ $event['date'] }}</span>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">{{ $event['time'] }}</span>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 mb-3 text-lg">Location</h3>
                <div class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="font-medium">{{ $event['location'] }}</span>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-900 mb-3 text-lg">Event Description</h3>
            <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $event['description'] }}</div>
        </div>

        <!-- Image Gallery -->
        @if(isset($event['images']) && count($event['images']) > 0)
            <div class="mb-6 pb-6 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4 text-lg">Gallery</h3>
                @if(count($event['images']) == 1)
                    <!-- Single Image -->
                    <div class="rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ $event['images'][0] }}" alt="{{ $event['title'] }}" class="w-full h-auto object-cover cursor-pointer hover:opacity-90 transition-opacity" onclick="openImageModal('{{ $event['images'][0] }}')">
                    </div>
                @elseif(count($event['images']) == 2)
                    <!-- Two Images -->
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($event['images'] as $index => $image)
                            <div class="rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ $image }}" alt="{{ $event['title'] }} - Image {{ $index + 1 }}" class="w-full h-64 object-cover cursor-pointer hover:opacity-90 transition-opacity" onclick="openImageModal('{{ $image }}', {{ json_encode($event['images']) }}, {{ $index }})">
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Multiple Images - First large, rest in grid -->
                    <div class="space-y-4">
                        <div class="rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ $event['images'][0] }}" alt="{{ $event['title'] }} - Main Image" class="w-full h-96 object-cover cursor-pointer hover:opacity-90 transition-opacity" onclick="openImageModal('{{ $event['images'][0] }}', {{ json_encode($event['images']) }}, 0)">
                        </div>
                        @if(count($event['images']) > 1)
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach(array_slice($event['images'], 1) as $index => $image)
                                    <div class="rounded-lg overflow-hidden border border-gray-200">
                                        <img src="{{ $image }}" alt="{{ $event['title'] }} - Image {{ $index + 2 }}" class="w-full h-48 object-cover cursor-pointer hover:opacity-90 transition-opacity" onclick="openImageModal('{{ $image }}', {{ json_encode($event['images']) }}, {{ $index + 1 }})">
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
                <div class="flex items-center gap-4 text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm">{{ $event['date'] }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <span class="text-sm">{{ $event['location'] }}</span>
                    </div>
                </div>
                <a href="{{ route('events.index') }}" class="px-6 py-2.5 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                    View All Events
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
