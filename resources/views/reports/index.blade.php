@extends('layouts.app')

@section('title', 'Reports & Tickets - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Reports & Tickets</h1>
                <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Track and manage community issues</p>
            </div>
            <div class="flex items-center gap-3">
                @if(session('user'))
                    <a href="{{ route('reports.index', ['my_reports' => 'true']) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>My Reports</span>
                    </a>
                @endif
                <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>New Report</span>
                </a>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-lg border border-gray-200">
                <div class="text-3xl font-bold text-gray-900 mb-1">142</div>
                <div class="text-sm text-gray-500 font-medium">Total</div>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-200">
                <div class="text-3xl font-bold text-[#65B741] mb-1">23</div>
                <div class="text-sm text-gray-500 font-medium">Open</div>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-200">
                <div class="text-3xl font-bold text-[#FFB534] mb-1">45</div>
                <div class="text-sm text-gray-500 font-medium">In Progress</div>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-200">
                <div class="text-3xl font-bold text-gray-700 mb-1">74</div>
                <div class="text-sm text-gray-500 font-medium">Completed</div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-4 gap-6">
        <!-- Sidebar Filters -->
        <div class="lg:col-span-1">
            <div class="bg-white p-5 rounded-lg border border-gray-200 sticky" style="top: 6rem;">
                <h3 class="text-sm font-bold text-gray-900 mb-5 uppercase tracking-wide">Filters</h3>
                
                <form method="GET" action="{{ route('reports.index') }}" class="space-y-5">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Category</label>
                        <select name="category" id="category-filter" value="{{ request('category') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none" style="background-color: white !important; background: white !important; color: #111827 !important;">
                            <option value="" {{ request('category') == '' ? 'selected' : '' }} style="background-color: white !important; background: white !important; color: #111827 !important;">All Categories</option>
                            <option value="road" {{ request('category') == 'road' ? 'selected' : '' }} style="background-color: white !important; background: white !important; color: #111827 !important;">Road Issues</option>
                            <option value="flooding" {{ request('category') == 'flooding' ? 'selected' : '' }} style="background-color: white !important; background: white !important; color: #111827 !important;">Flooding/Drainage</option>
                            <option value="streetlights" {{ request('category') == 'streetlights' ? 'selected' : '' }} style="background-color: white !important; background: white !important; color: #111827 !important;">Broken Streetlights</option>
                            <option value="garbage" {{ request('category') == 'garbage' ? 'selected' : '' }} style="background-color: white !important; background: white !important; color: #111827 !important;">Garbage/Cleanliness</option>
                            <option value="noise" {{ request('category') == 'noise' ? 'selected' : '' }} style="background-color: white !important; background: white !important; color: #111827 !important;">Noise Complaints</option>
                            <option value="safety" {{ request('category') == 'safety' ? 'selected' : '' }} style="background-color: white !important; background: white !important; color: #111827 !important;">Safety/Security</option>
                            <option value="lost" {{ request('category') == 'lost' ? 'selected' : '' }} style="background-color: white !important; background: white !important; color: #111827 !important;">Lost & Found</option>
                            <option value="animals" {{ request('category') == 'animals' ? 'selected' : '' }} style="background-color: white !important; background: white !important; color: #111827 !important;">Stray Animals</option>
                            <option value="other" {{ request('category') == 'other' ? 'selected' : '' }} style="background-color: white !important; background: white !important; color: #111827 !important;">Other</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Status</label>
                        <div class="space-y-2">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="status[]" value="open" {{ in_array('open', request('status', [])) ? 'checked' : '' }} class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900" style="transition: none !important;">
                                <span class="ml-2 text-sm text-gray-700" style="transition: none !important;">Open</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="status[]" value="in_progress" {{ in_array('in_progress', request('status', [])) ? 'checked' : '' }} class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900" style="transition: none !important;">
                                <span class="ml-2 text-sm text-gray-700" style="transition: none !important;">In Progress</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="status[]" value="completed" {{ in_array('completed', request('status', [])) ? 'checked' : '' }} class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900" style="transition: none !important;">
                                <span class="ml-2 text-sm text-gray-700" style="transition: none !important;">Completed</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="status[]" value="under_review" {{ in_array('under_review', request('status', [])) ? 'checked' : '' }} class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900" style="transition: none !important;">
                                <span class="ml-2 text-sm text-gray-700" style="transition: none !important;">Under Review</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Priority</label>
                        <div class="space-y-2">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="priority[]" value="high" {{ in_array('high', request('priority', [])) ? 'checked' : '' }} class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900" style="transition: none !important;">
                                <span class="ml-2 text-sm text-gray-700" style="transition: none !important;">High</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="priority[]" value="normal" {{ in_array('normal', request('priority', [])) ? 'checked' : '' }} class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900" style="transition: none !important;">
                                <span class="ml-2 text-sm text-gray-700" style="transition: none !important;">Normal</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="priority[]" value="low" {{ in_array('low', request('priority', [])) ? 'checked' : '' }} class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900" style="transition: none !important;">
                                <span class="ml-2 text-sm text-gray-700" style="transition: none !important;">Low</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Search</label>
                        <div class="relative">
                            <input type="text" name="search" id="search-filter" value="{{ request('search') }}" class="w-full px-3 py-2 pl-9 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none" placeholder="Search..." style="background-color: white !important; color: #111827 !important;">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-gray-900 text-white font-semibold py-2.5 rounded-lg">
                        Apply Filters
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            @if(request('my_reports') && session('user'))
                <div class="mb-4 flex items-center gap-2">
                    <a href="{{ route('reports.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <h2 class="text-lg font-bold text-gray-900">My Reports</h2>
                </div>
            @endif

            <!-- Reports Grid -->
            <div class="grid md:grid-cols-2 gap-4 mb-6">
                @php
                    // Generate a larger dataset for pagination
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

                    // Apply filters
                    $filteredReports = $allReports;
                    
                    if (request('category')) {
                        $categoryMap = [
                            'road' => 'Road Issues',
                            'flooding' => 'Flooding/Drainage',
                            'streetlights' => 'Broken Streetlights',
                            'garbage' => 'Garbage/Cleanliness',
                            'noise' => 'Noise Complaints',
                            'safety' => 'Safety/Security',
                            'lost' => 'Lost & Found',
                            'animals' => 'Stray Animals',
                            'other' => 'Other'
                        ];
                        $categoryFilter = $categoryMap[request('category')] ?? null;
                        if ($categoryFilter) {
                            $filteredReports = array_filter($filteredReports, function($report) use ($categoryFilter) {
                                return $report['category'] === $categoryFilter;
                            });
                        }
                    }
                    
                    if (request('status')) {
                        $statusMap = [
                            'open' => 'Open',
                            'in_progress' => 'In Progress',
                            'completed' => 'Completed',
                            'under_review' => 'Under Review'
                        ];
                        $statusFilters = array_map(function($s) use ($statusMap) {
                            return $statusMap[$s] ?? null;
                        }, request('status', []));
                        $statusFilters = array_filter($statusFilters);
                        if (!empty($statusFilters)) {
                            $filteredReports = array_filter($filteredReports, function($report) use ($statusFilters) {
                                return in_array($report['status'], $statusFilters);
                            });
                        }
                    }
                    
                    if (request('priority')) {
                        $priorityMap = [
                            'high' => 'High',
                            'normal' => 'Normal',
                            'low' => 'Low'
                        ];
                        $priorityFilters = array_map(function($p) use ($priorityMap) {
                            return $priorityMap[$p] ?? null;
                        }, request('priority', []));
                        $priorityFilters = array_filter($priorityFilters);
                        if (!empty($priorityFilters)) {
                            $filteredReports = array_filter($filteredReports, function($report) use ($priorityFilters) {
                                return in_array($report['priority'], $priorityFilters);
                            });
                        }
                    }
                    
                    if (request('search')) {
                        $searchTerm = strtolower(request('search'));
                        $filteredReports = array_filter($filteredReports, function($report) use ($searchTerm) {
                            return strpos(strtolower($report['title']), $searchTerm) !== false ||
                                   strpos(strtolower($report['description']), $searchTerm) !== false ||
                                   strpos(strtolower($report['ticket_id']), $searchTerm) !== false;
                        });
                    }
                    
                    // Filter by user if "My Reports" is requested
                    if (request('my_reports') && session('user')) {
                        $userEmail = session('user')['email'];
                        // For demo: show reports 1, 3, 5, 7, 9, 11 for jon@gmail.com and reports 2, 4, 6, 8, 10, 12 for makoy@gmail.com
                        $userReportIds = $userEmail === 'jon@gmail.com' ? [1, 3, 5, 7, 9, 11] : [2, 4, 6, 8, 10, 12];
                        $filteredReports = array_filter($filteredReports, function($report) use ($userReportIds) {
                            return in_array($report['id'], $userReportIds);
                        });
                    }
                    
                    // Reset array keys
                    $filteredReports = array_values($filteredReports);
                    
                    // Paginate
                    $perPage = 6;
                    $currentPage = request('page', 1);
                    $total = count($filteredReports);
                    $offset = ($currentPage - 1) * $perPage;
                    $reports = array_slice($filteredReports, $offset, $perPage);
                    
                    // Create paginator
                    $reports = new \Illuminate\Pagination\LengthAwarePaginator(
                        $reports,
                        $total,
                        $perPage,
                        $currentPage,
                        ['path' => request()->url(), 'query' => request()->query()]
                    );
                @endphp

                @if(count($reports) > 0)
                @foreach($reports as $report)
                <a href="{{ route('reports.show', $report['id']) }}" class="block group">
                    <div class="bg-white p-5 rounded-lg border border-gray-200 h-full flex flex-col hover:border-gray-300 hover:shadow-md">
                        <!-- Header -->
                        <div class="mb-4">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-base font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">
                                    {{ $report['title'] }}
                                </h3>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            
                            <div class="flex items-center gap-2 flex-wrap">
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
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed flex-grow">
                            {{ $report['description'] }}
                        </p>

                        <!-- Footer Info -->
                        <div class="pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-4 text-gray-500">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        <span class="font-medium">{{ $report['location'] }}</span>
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-medium">{{ $report['date'] }}</span>
                                    </span>
                                </div>
                                <span class="text-gray-400 font-mono text-xs">{{ $report['ticket_id'] }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <div class="col-span-2 text-center py-12">
                    <p class="text-gray-500 text-lg">No reports found matching your filters.</p>
                </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($reports->hasPages())
            <div class="flex justify-center mt-6">
                <div class="flex items-center gap-2">
                    @if($reports->onFirstPage())
                        <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $reports->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Previous</a>
                    @endif

                    @foreach($reports->getUrlRange(1, $reports->lastPage()) as $page => $url)
                        @if($page == $reports->currentPage())
                            <span class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($reports->hasMorePages())
                        <a href="{{ $reports->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</a>
                    @else
                        <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
