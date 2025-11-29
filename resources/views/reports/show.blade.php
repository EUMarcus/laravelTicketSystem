@extends('layouts.app')

@section('title', 'Report Details - Community Hub')

@section('content')
@php
    // Same dataset as index page
    $allReports = [
        ['id' => 1, 'ticket_id' => 'RPT-2024-001', 'title' => 'Broken Streetlight on Main Street', 'category' => 'Broken Streetlights', 'status' => 'In Progress', 'priority' => 'High', 'location' => 'Main Street, Block 5', 'date' => '2 days ago', 'description' => 'Streetlight has been flickering and now completely out. Need immediate attention for safety.'],
        ['id' => 2, 'ticket_id' => 'RPT-2024-002', 'title' => 'Large Pothole Near Community Center', 'category' => 'Road Issues', 'status' => 'Under Review', 'priority' => 'Normal', 'location' => 'Community Center Road', 'date' => '3 days ago', 'description' => 'Deep pothole causing vehicle damage. Located right before the community center entrance.'],
        ['id' => 3, 'ticket_id' => 'RPT-2024-003', 'title' => 'Garbage Not Collected This Week', 'category' => 'Garbage/Cleanliness', 'status' => 'Completed', 'priority' => 'Normal', 'location' => 'Block 3, Barangay Road', 'date' => '1 week ago', 'description' => 'Garbage collection missed scheduled pickup. Trash accumulating.'],
        ['id' => 4, 'ticket_id' => 'RPT-2024-004', 'title' => 'Flooding in Barangay Road After Rain', 'category' => 'Flooding/Drainage', 'status' => 'Open', 'priority' => 'High', 'location' => 'Barangay Road, Corner Street', 'date' => '1 week ago', 'description' => 'Water accumulates after heavy rain, blocking vehicle passage.'],
        ['id' => 5, 'ticket_id' => 'RPT-2024-005', 'title' => 'Stray Dogs in Children\'s Park', 'category' => 'Stray Animals', 'status' => 'In Progress', 'priority' => 'Normal', 'location' => 'Children\'s Park Area', 'date' => '2 weeks ago', 'description' => 'Multiple stray dogs frequenting the park, causing concern for children safety.'],
        ['id' => 6, 'ticket_id' => 'RPT-2024-006', 'title' => 'Noise Complaint - Late Night Construction', 'category' => 'Noise Complaints', 'status' => 'Open', 'priority' => 'Low', 'location' => 'Block 7, Residential Area', 'date' => '3 days ago', 'description' => 'Construction work happening past 10 PM, disturbing residents.'],
        ['id' => 7, 'ticket_id' => 'RPT-2024-007', 'title' => 'Damaged Sidewalk Tiles', 'category' => 'Road Issues', 'status' => 'Open', 'priority' => 'Normal', 'location' => 'Block 2, Main Walkway', 'date' => '4 days ago', 'description' => 'Several sidewalk tiles are cracked and pose tripping hazard.'],
        ['id' => 8, 'ticket_id' => 'RPT-2024-008', 'title' => 'Overflowing Drainage System', 'category' => 'Flooding/Drainage', 'status' => 'In Progress', 'priority' => 'High', 'location' => 'Block 4, Corner Street', 'date' => '5 days ago', 'description' => 'Drainage system overflowing during heavy rains, flooding nearby areas.'],
        ['id' => 9, 'ticket_id' => 'RPT-2024-009', 'title' => 'Uncollected Trash Bins', 'category' => 'Garbage/Cleanliness', 'status' => 'Open', 'priority' => 'Normal', 'location' => 'Block 6, Residential Area', 'date' => '1 day ago', 'description' => 'Trash bins have not been emptied for over a week.'],
        ['id' => 10, 'ticket_id' => 'RPT-2024-010', 'title' => 'Flickering Streetlight', 'category' => 'Broken Streetlights', 'status' => 'Under Review', 'priority' => 'Low', 'location' => 'Block 8, Park Entrance', 'date' => '6 days ago', 'description' => 'Streetlight flickers intermittently, needs maintenance check.'],
        ['id' => 11, 'ticket_id' => 'RPT-2024-011', 'title' => 'Loud Music from Neighbor', 'category' => 'Noise Complaints', 'status' => 'Open', 'priority' => 'Low', 'location' => 'Block 1, Residential Area', 'date' => '2 days ago', 'description' => 'Excessive noise from neighbor playing loud music late at night.'],
        ['id' => 12, 'ticket_id' => 'RPT-2024-012', 'title' => 'Suspicious Activity Reported', 'category' => 'Safety/Security', 'status' => 'In Progress', 'priority' => 'High', 'location' => 'Block 5, Community Center', 'date' => '1 day ago', 'description' => 'Reports of suspicious individuals loitering around community center.'],
    ];
    
    // Find the report by ID
    $report = collect($allReports)->firstWhere('id', (int)$id);
    
    // If report not found, redirect or show 404
    if (!$report) {
        abort(404, 'Report not found');
    }
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('reports.index') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-medium">Back to Reports</span>
        </a>
    </div>

    <!-- Report Details Card -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 lg:p-8">
        <!-- Header -->
        <div class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex items-center gap-2 flex-wrap mb-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                    {{ $report['category'] }}
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                    @if($report['status'] === 'Open') bg-[#65B741]/10 text-[#65B741] border border-[#65B741]/20
                    @elseif($report['status'] === 'In Progress') bg-[#FFB534]/10 text-[#FFB534] border border-[#FFB534]/20
                    @elseif($report['status'] === 'Completed') bg-gray-100 text-gray-700 border border-gray-200
                    @else bg-gray-100 text-gray-600 border border-gray-200 @endif">
                    {{ $report['status'] }}
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                    @if($report['priority'] === 'High') bg-red-50 text-red-700 border border-red-200
                    @elseif($report['priority'] === 'Normal') bg-yellow-50 text-yellow-700 border border-yellow-200
                    @else bg-gray-50 text-gray-600 border border-gray-200 @endif">
                    {{ $report['priority'] }}
                </span>
                <span class="text-gray-400 font-mono text-xs">{{ $report['ticket_id'] }}</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $report['title'] }}</h1>
            <p class="text-gray-600">Reported {{ $report['date'] }}</p>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-3">Description</h2>
            <p class="text-gray-700 leading-relaxed text-base">{{ $report['description'] }}</p>
        </div>

        <!-- Details Grid -->
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <h3 class="text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">Location</h3>
                <div class="flex items-center gap-2 text-gray-900">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="font-medium">{{ $report['location'] }}</span>
                </div>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <h3 class="text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">Reported</h3>
                <div class="flex items-center gap-2 text-gray-900">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">{{ $report['date'] }}</span>
                </div>
            </div>
        </div>

        <!-- Photo Section -->
        <div class="border-t border-gray-200 pt-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Photo</h2>
            <div class="bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800" alt="Report photo" class="w-full h-auto object-cover">
            </div>
        </div>
    </div>
</div>
@endsection

