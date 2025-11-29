@extends('layouts.app')

@section('title', 'Reports & Tickets - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4" data-aos="fade-down">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">Reports & Tickets</h1>
            <p class="text-text-secondary">Report community issues and track their progress</p>
        </div>
        <a href="{{ route('reports.create') }}" class="btn-primary px-6 py-3 rounded-lg flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>New Report</span>
        </a>
        <div class="text-xs text-text-muted mt-2">* Login required to submit</div>
    </div>

    <!-- Filters -->
    <div class="modern-card p-6 mb-6" data-aos="fade-up">
        <div class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Category</label>
                <select class="modern-input text-sm">
                    <option>All Categories</option>
                    <option>Road Issues</option>
                    <option>Flooding/Drainage</option>
                    <option>Broken Streetlights</option>
                    <option>Garbage/Cleanliness</option>
                    <option>Noise Complaints</option>
                    <option>Safety/Security</option>
                    <option>Lost & Found</option>
                    <option>Stray Animals</option>
                    <option>Other</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Status</label>
                <select class="modern-input text-sm">
                    <option>All Status</option>
                    <option>Open</option>
                    <option>Under Review</option>
                    <option>In Progress</option>
                    <option>Completed</option>
                    <option>Closed</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Priority</label>
                <select class="modern-input text-sm">
                    <option>All Priority</option>
                    <option>Low</option>
                    <option>Normal</option>
                    <option>High</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Search</label>
                <input type="text" class="modern-input text-sm" placeholder="Search reports...">
            </div>
        </div>
    </div>

    <!-- Reports Grid -->
    <div class="grid gap-4 lg:gap-6">
        @php
            $reports = [
                ['id' => 1, 'ticket_id' => 'RPT-2024-001', 'title' => 'Broken Streetlight on Main Street', 'category' => 'Broken Streetlights', 'status' => 'In Progress', 'priority' => 'High', 'location' => 'Main Street, Block 5', 'date' => '2 days ago', 'description' => 'Streetlight has been flickering and now completely out. Need immediate attention for safety.'],
                ['id' => 2, 'ticket_id' => 'RPT-2024-002', 'title' => 'Large Pothole Near Community Center', 'category' => 'Road Issues', 'status' => 'Under Review', 'priority' => 'Normal', 'location' => 'Community Center Road', 'date' => '3 days ago', 'description' => 'Deep pothole causing vehicle damage. Located right before the community center entrance.'],
                ['id' => 3, 'ticket_id' => 'RPT-2024-003', 'title' => 'Garbage Not Collected This Week', 'category' => 'Garbage/Cleanliness', 'status' => 'Completed', 'priority' => 'Normal', 'location' => 'Block 3, Barangay Road', 'date' => '1 week ago', 'description' => 'Garbage collection missed scheduled pickup. Trash accumulating.'],
                ['id' => 4, 'ticket_id' => 'RPT-2024-004', 'title' => 'Flooding in Barangay Road After Rain', 'category' => 'Flooding/Drainage', 'status' => 'Open', 'priority' => 'High', 'location' => 'Barangay Road, Corner Street', 'date' => '1 week ago', 'description' => 'Water accumulates after heavy rain, blocking vehicle passage.'],
                ['id' => 5, 'ticket_id' => 'RPT-2024-005', 'title' => 'Stray Dogs in Children\'s Park', 'category' => 'Stray Animals', 'status' => 'In Progress', 'priority' => 'Normal', 'location' => 'Children\'s Park Area', 'date' => '2 weeks ago', 'description' => 'Multiple stray dogs frequenting the park, causing concern for children safety.'],
                ['id' => 6, 'ticket_id' => 'RPT-2024-006', 'title' => 'Noise Complaint - Late Night Construction', 'category' => 'Noise Complaints', 'status' => 'Open', 'priority' => 'Low', 'location' => 'Block 7, Residential Area', 'date' => '3 days ago', 'description' => 'Construction work happening past 10 PM, disturbing residents.'],
            ];
        @endphp

        @foreach($reports as $report)
        <a href="{{ route('reports.show', $report['id']) }}" class="block group">
            <div class="modern-card p-6 hover-lift border-l-4 
                @if($report['status'] === 'Open') border-primary 
                @elseif($report['status'] === 'In Progress') border-warning 
                @elseif($report['status'] === 'Completed') border-success 
                @else border-gray-400 @endif"
                data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-3 flex-wrap">
                            <h3 class="text-xl font-semibold text-text-primary group-hover:text-primary transition-colors">
                                {{ $report['title'] }}
                            </h3>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-green-light-bg text-primary">
                    {{ $report['category'] }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    @if($report['status'] === 'Open') bg-primary-lighter text-primary
                    @elseif($report['status'] === 'In Progress') bg-accent-orange-light text-accent-orange
                    @elseif($report['status'] === 'Completed') bg-primary-lighter text-primary
                    @else bg-gray-100 text-text-secondary @endif">
                    {{ $report['status'] }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-text-secondary">
                    {{ $report['priority'] }}
                </span>
                        </div>
                        
                        <p class="text-text-secondary mb-4 line-clamp-2 leading-relaxed">
                            {{ $report['description'] }}
                        </p>

                        <div class="flex items-center gap-4 text-sm text-text-muted flex-wrap">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                {{ $report['ticket_id'] }}
                            </span>
                            <span>•</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                {{ $report['location'] }}
                            </span>
                            <span>•</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $report['date'] }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-text-muted group-hover:text-primary group-hover:translate-x-1 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center" data-aos="fade-up">
        <div class="flex items-center space-x-2">
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-text-secondary hover:bg-gray-50">Previous</button>
            <button class="px-4 py-2 bg-primary text-white rounded-lg">1</button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-text-secondary hover:bg-gray-50">2</button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-text-secondary hover:bg-gray-50">3</button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-text-secondary hover:bg-gray-50">Next</button>
        </div>
    </div>
</div>
@endsection

