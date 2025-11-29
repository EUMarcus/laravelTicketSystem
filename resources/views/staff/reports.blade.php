@extends('layouts.app')

@section('title', 'Reports - Staff Dashboard')

@section('content')
@if(session('user') && session('user')['role'] === 'employee')
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
                        <span class="font-medium">Announcements</span>
                    </a>
                    
                    <a href="{{ route('staff.events') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.events') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">Events</span>
                    </a>
                    
                    <a href="{{ route('staff.polls') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.polls') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-medium">Polls</span>
                    </a>
                </div>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-10">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                    <div>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Reports & Tickets</h1>
                        <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                        <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Track and manage community issues</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>New Report</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Section Separator -->
            <div class="mb-8 pt-6 border-t border-gray-200">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Public Reports</h2>
                <p class="text-sm text-gray-600">Browse all community reports and issues</p>
            </div>

            <!-- Regular Reports - With Sidebar -->
            <div class="grid lg:grid-cols-4 gap-6">
                <!-- Sidebar Filters -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-5 rounded-lg border border-gray-200 sticky" style="top: 6rem;">
                        <h3 class="text-sm font-bold text-gray-900 mb-5 uppercase tracking-wide">Filters</h3>
                        
                        <form method="GET" action="{{ route('staff.reports') }}" class="space-y-5">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Category</label>
                                <select name="category" id="category-filter" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none" style="background-color: white !important; background: white !important; color: #111827 !important;" onchange="this.form.submit()">
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
                    <!-- Reports Grid -->
                    <div id="reportsGrid" class="grid md:grid-cols-2 gap-4 mb-6">
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
    </main>
</div>
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

