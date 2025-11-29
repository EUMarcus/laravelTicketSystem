@extends('layouts.app')

@section('title', 'Manage My Reports - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Manage My Reports</h1>
                <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl">View and manage all your submitted reports</p>
            </div>
            <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Reports</span>
            </a>
        </div>
    </div>

    <!-- Reports Grid -->
    <div id="reportsGrid" class="grid md:grid-cols-2 gap-4 mb-6">
        <!-- Loading state -->
        <div id="myReportsLoading" class="col-span-2 text-center py-12">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-[#65B741]"></div>
            <p class="mt-4 text-gray-600">Loading your reports...</p>
        </div>

        <!-- Empty state -->
        <div id="myReportsEmpty" class="col-span-2 text-center py-12 hidden">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No Reports Yet</h3>
            <p class="text-gray-600 mb-6">You haven't submitted any reports yet.</p>
            <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Create Your First Report</span>
            </a>
        </div>
    </div>
</div>

@if(session('user'))
<script>
    // Set current user info for ReportManager
    window.currentUserEmail = '{{ session("user")["email"] }}';
    window.currentUserName = '{{ session("user")["name"] }}';
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reportManager = new ReportManager();
    const userEmail = window.currentUserEmail;
    
    // Check if user has any reports
    const userReports = reportManager.getUserReports();
    
    // If no reports exist, initialize with example data
    if (userReports.length === 0 && userEmail) {
        const exampleReports = [
            {
                category: 'Road Issues',
                title: 'Large Pothole on Main Street',
                description: 'There is a large pothole on Main Street near the intersection with Oak Avenue. It has been getting worse and is now causing damage to vehicles. The pothole is approximately 2 feet wide and 6 inches deep.',
                location: 'Main Street, Block 5',
                priority: 'High',
                photos: [],
                status: 'Open',
                createdAt: new Date(Date.now() - 2 * 24 * 60 * 60 * 1000).toISOString(),
                updatedAt: new Date(Date.now() - 2 * 24 * 60 * 60 * 1000).toISOString()
            },
            {
                category: 'Broken Streetlights',
                title: 'Streetlight Out on Park Avenue',
                description: 'The streetlight at the corner of Park Avenue and Elm Street has been out for over a week. This area is very dark at night and poses a safety concern for pedestrians.',
                location: 'Park Avenue, Corner of Elm Street',
                priority: 'Normal',
                photos: [],
                status: 'In Progress',
                createdAt: new Date(Date.now() - 5 * 24 * 60 * 60 * 1000).toISOString(),
                updatedAt: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000).toISOString()
            },
            {
                category: 'Garbage/Cleanliness',
                title: 'Trash Bins Not Collected',
                description: 'The garbage collection was missed this week. Trash bins are overflowing and creating an unpleasant smell. This is the second time this month.',
                location: 'Block 3, Residential Area',
                priority: 'Normal',
                photos: [],
                status: 'Open',
                createdAt: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000).toISOString(),
                updatedAt: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000).toISOString()
            },
            {
                category: 'Flooding/Drainage',
                title: 'Water Accumulation After Rain',
                description: 'After heavy rain, water accumulates in front of my house and takes hours to drain. This happens every time it rains and is getting worse.',
                location: 'Block 7, Corner Street',
                priority: 'High',
                photos: [],
                status: 'Under Review',
                createdAt: new Date(Date.now() - 3 * 24 * 60 * 60 * 1000).toISOString(),
                updatedAt: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000).toISOString()
            },
            {
                category: 'Noise Complaints',
                title: 'Loud Construction Noise Early Morning',
                description: 'Construction work is starting at 6 AM every morning, which is disturbing the peace. The noise is very loud and wakes up the entire neighborhood.',
                location: 'Block 2, Near Community Center',
                priority: 'Low',
                photos: [],
                status: 'Open',
                createdAt: new Date(Date.now() - 4 * 24 * 60 * 60 * 1000).toISOString(),
                updatedAt: new Date(Date.now() - 4 * 24 * 60 * 60 * 1000).toISOString()
            },
            {
                category: 'Safety/Security',
                title: 'Broken Fence at Playground',
                description: 'The fence around the children\'s playground has a large gap where kids could easily get out. This is a safety hazard that needs immediate attention.',
                location: 'Community Park, Playground Area',
                priority: 'High',
                photos: [],
                status: 'Completed',
                createdAt: new Date(Date.now() - 10 * 24 * 60 * 60 * 1000).toISOString(),
                updatedAt: new Date(Date.now() - 2 * 24 * 60 * 60 * 1000).toISOString()
            }
        ];

        // Save example reports
        exampleReports.forEach(reportData => {
            // Manually create report with user info
            const allReports = reportManager.getAllReports();
            const newReport = {
                id: reportManager.generateReportId(),
                userEmail: userEmail,
                userName: window.currentUserName,
                ...reportData
            };
            allReports.push(newReport);
            localStorage.setItem('user_reports', JSON.stringify(allReports));
        });

        // Reload reports
        loadMyReports();
    } else {
        loadMyReports();
    }

    function loadMyReports() {
        const reportManager = new ReportManager();
        const userReports = reportManager.getUserReports();
        const loadingDiv = document.getElementById('myReportsLoading');
        const emptyDiv = document.getElementById('myReportsEmpty');
        const reportsGrid = document.getElementById('reportsGrid');

        if (loadingDiv) loadingDiv.classList.add('hidden');

        if (userReports.length === 0) {
            if (emptyDiv) emptyDiv.classList.remove('hidden');
            return;
        }

        if (emptyDiv) emptyDiv.classList.add('hidden');

        // Render reports
        reportsGrid.innerHTML = userReports.map(report => {
            const timeAgo = reportManager.formatDate(report.createdAt);
            const statusClass = report.status === 'Open' 
                ? 'bg-[#65B741]/10 text-[#65B741] border border-[#65B741]/20'
                : report.status === 'In Progress'
                ? 'bg-[#FFB534]/10 text-[#FFB534] border border-[#FFB534]/20'
                : report.status === 'Completed'
                ? 'bg-gray-100 text-gray-700 border border-gray-200'
                : 'bg-gray-100 text-gray-600 border border-gray-200';
            
            const priorityClass = report.priority === 'High'
                ? 'bg-red-50 text-red-700 border border-red-200'
                : report.priority === 'Normal'
                ? 'bg-yellow-50 text-yellow-700 border border-yellow-200'
                : 'bg-gray-50 text-gray-600 border border-gray-200';

            return `
                <a href="/reports/${report.id}?from=my-reports" class="block group">
                    <div class="bg-white p-5 rounded-lg border border-gray-200 h-full flex flex-col hover:border-gray-300 hover:shadow-md">
                        <div class="mb-4">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-base font-bold text-gray-900 line-clamp-2 flex-1 group-hover:text-gray-700">
                                    ${report.title || 'Untitled Report'}
                                </h3>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 flex-shrink-0 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                    ${report.category || 'N/A'}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium ${statusClass}">
                                    ${report.status || 'Open'}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium ${priorityClass}">
                                    ${report.priority || 'Normal'}
                                </span>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed flex-grow">
                            ${report.description || 'No description provided.'}
                        </p>
                        <div class="pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-4 text-gray-500">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        <span class="font-medium">${report.location || 'Not specified'}</span>
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-medium">${timeAgo}</span>
                                    </span>
                                </div>
                                <span class="text-gray-400 font-mono text-xs">${report.id || ''}</span>
                            </div>
                        </div>
                    </div>
                </a>
            `;
        }).join('');
    }
});
</script>
@else
<script>
    // Redirect to login if not authenticated
    window.location.href = '{{ route("login") }}';
</script>
@endif
@endsection

