@extends('layouts.app')

@section('title', 'Report Details - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('reports.index') }}" id="backButton" class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-medium">Back to Reports</span>
        </a>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Report Details Card -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 lg:p-8 mb-6" id="reportDetailsCard">
                <!-- Loading state -->
                <div id="loadingState" class="text-center py-12">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-[#65B741]"></div>
                    <p class="mt-4 text-gray-600">Loading report...</p>
                </div>

                <!-- Report content (hidden initially) -->
                <div id="reportContent" class="hidden">
                    <!-- Header -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span id="reportCategory" class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200"></span>
                                <span id="reportStatus" class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium"></span>
                                <span id="reportPriority" class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium"></span>
                                <span id="reportTicketId" class="text-gray-400 font-mono text-xs"></span>
                            </div>
                            <!-- Public Toggle (only for report owner) -->
                            <div id="publicToggleContainer" class="hidden flex items-center gap-3">
                                <span class="text-sm text-gray-600 font-medium">Share Publicly</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="publicToggle" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#65B741] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#65B741]"></div>
                                </label>
                            </div>
                        </div>
                        <h1 id="reportTitle" class="text-3xl md:text-4xl font-bold text-gray-900 mb-2"></h1>
                        <p id="reportDate" class="text-gray-600"></p>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-3">Description</h2>
                        <p id="reportDescription" class="text-gray-700 leading-relaxed text-base"></p>
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
                                <span id="reportLocation" class="font-medium"></span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">Reported By</h3>
                            <div class="flex items-center gap-2 text-gray-900">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span id="reportAuthor" class="font-medium"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Photos/Attachments Section -->
                    <div id="photoSection" class="border-t border-gray-200 pt-6 hidden">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Photos & Attachments</h2>
                        <div id="photosGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>
                    </div>
                </div>

                <!-- Not found state -->
                <div id="notFoundState" class="hidden text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Report Not Found</h3>
                    <p class="text-gray-600 mb-6">The report you're looking for doesn't exist or has been removed.</p>
                    <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                        <span>Back to Reports</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Chat Section -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm" id="chatSection">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Chat with Staff</h3>
                    <p class="text-xs text-gray-500 mt-1">Follow up on your report</p>
                </div>

                <!-- Chat Messages -->
                <div id="chatMessages" class="h-96 overflow-y-auto p-4 space-y-4 bg-gray-50">
                    <div class="text-center text-gray-500 text-sm py-8">
                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p>No messages yet. Start the conversation!</p>
                    </div>
                </div>

                <!-- Chat Input -->
                <div class="p-4 border-t border-gray-200 bg-white">
                    @if(session('user'))
                        <form id="chatForm" class="space-y-2">
                            <!-- File Upload Area -->
                            <div id="chatFilePreview" class="hidden mb-2">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <div id="chatFileList" class="flex items-center gap-2 flex-wrap"></div>
                                    <button type="button" onclick="clearChatFiles()" class="text-xs text-red-600 hover:text-red-800 font-semibold">Clear All</button>
                                </div>
                            </div>
                            
                            <div class="flex gap-2">
                                <div class="flex-1 relative">
                                    <input type="text" id="chatInput" placeholder="Type your message..." class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-[#65B741] outline-none" required>
                                    <input type="file" id="chatFileInput" multiple accept="image/*,.pdf,.doc,.docx" class="hidden">
                                </div>
                                <button type="button" onclick="document.getElementById('chatFileInput').click()" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors" title="Attach file">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                </button>
                                <button type="submit" class="px-4 py-2 bg-[#65B741] text-white rounded-lg hover:bg-[#4d8a32] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-4">
                            <p class="text-sm text-gray-600 mb-3">Please log in to chat</p>
                            <a href="{{ route('login') }}" class="text-sm text-[#65B741] hover:text-[#4d8a32] font-semibold">Login</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('user'))
<script>
    // Set current user info for ReportManager
    window.currentUserEmail = '{{ session("user")["email"] }}';
    window.currentUserName = '{{ session("user")["name"] }}';
    window.currentUserRole = '{{ session("user")["role"] }}';
</script>
@endif
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reportManager = new ReportManager();
    const reportId = '{{ $id }}';
    let chatRefreshInterval;

    // Update back button based on URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const backButton = document.getElementById('backButton');
    if (backButton && urlParams.get('from') === 'my-reports') {
        backButton.href = '{{ route("reports.my-reports") }}';
        backButton.querySelector('span').textContent = 'Back to My Reports';
    }

    // Load and display report
    function loadReport() {
        // First try to get from localStorage (for "My Reports")
        let report = reportManager.getReportById(reportId);
        
        // If not found in localStorage, try PHP hardcoded data (for public reports)
        if (!report) {
            // This will be handled by PHP fallback if needed
            // For now, we'll show not found
        }
        
        if (!report) {
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('notFoundState').classList.remove('hidden');
            return;
        }

        // Display report data
        document.getElementById('reportCategory').textContent = report.category || 'N/A';
        document.getElementById('reportStatus').textContent = report.status || 'Open';
        document.getElementById('reportPriority').textContent = report.priority || 'Normal';
        document.getElementById('reportTicketId').textContent = report.id || '';
        document.getElementById('reportTitle').textContent = report.title || 'Untitled Report';
        document.getElementById('reportDescription').textContent = report.description || 'No description provided.';
        document.getElementById('reportLocation').textContent = report.location || 'Not specified';
        document.getElementById('reportAuthor').textContent = report.userName || 'Unknown';
        
        // Format date
        const reportDate = reportManager.formatDate(report.createdAt);
        document.getElementById('reportDate').textContent = `Reported ${reportDate}`;

        // Status badge styling
        const statusBadge = document.getElementById('reportStatus');
        statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium';
        if (report.status === 'Open') {
            statusBadge.classList.add('bg-[#65B741]/10', 'text-[#65B741]', 'border', 'border-[#65B741]/20');
        } else if (report.status === 'In Progress') {
            statusBadge.classList.add('bg-[#FFB534]/10', 'text-[#FFB534]', 'border', 'border-[#FFB534]/20');
        } else if (report.status === 'Completed') {
            statusBadge.classList.add('bg-gray-100', 'text-gray-700', 'border', 'border-gray-200');
        } else {
            statusBadge.classList.add('bg-gray-100', 'text-gray-600', 'border', 'border-gray-200');
        }

        // Priority badge styling
        const priorityBadge = document.getElementById('reportPriority');
        priorityBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium';
        if (report.priority === 'High') {
            priorityBadge.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-200');
        } else if (report.priority === 'Normal') {
            priorityBadge.classList.add('bg-yellow-50', 'text-yellow-700', 'border', 'border-yellow-200');
        } else {
            priorityBadge.classList.add('bg-gray-50', 'text-gray-600', 'border', 'border-gray-200');
        }

        // Display photos/attachments if available
        if (report.photos && report.photos.length > 0) {
            const photosGrid = document.getElementById('photosGrid');
            photosGrid.innerHTML = '';
            
            report.photos.forEach((file, index) => {
                const fileDiv = document.createElement('div');
                fileDiv.className = 'bg-gray-100 rounded-lg overflow-hidden border border-gray-200';
                
                if (file.type && file.type.startsWith('image/')) {
                    fileDiv.innerHTML = `
                        <img src="${file.data}" alt="${file.name || 'Photo ' + (index + 1)}" class="w-full h-48 object-cover cursor-pointer" onclick="openImageModal('${file.data}', '${file.name || 'Photo'}')">
                        <div class="p-2">
                            <p class="text-xs text-gray-600 truncate" title="${file.name || 'Photo'}">${file.name || 'Photo ' + (index + 1)}</p>
                        </div>
                    `;
                } else {
                    fileDiv.innerHTML = `
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="p-2">
                            <p class="text-xs text-gray-600 truncate" title="${file.name || 'File'}">${file.name || 'File ' + (index + 1)}</p>
                            <a href="${file.data}" download="${file.name || 'file'}" class="text-xs text-[#65B741] hover:text-[#4d8a32] font-semibold mt-1 inline-block">Download</a>
                        </div>
                    `;
                }
                
                photosGrid.appendChild(fileDiv);
            });
            
            document.getElementById('photoSection').classList.remove('hidden');
        }
        
        // Image modal function
        window.openImageModal = function(imageSrc, imageName) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75';
            modal.innerHTML = `
                <div class="relative max-w-4xl max-h-full p-4">
                    <button onclick="this.closest('.fixed').remove()" class="absolute top-4 right-4 bg-white rounded-full p-2 hover:bg-gray-100 z-10">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <img src="${imageSrc}" alt="${imageName}" class="max-w-full max-h-[90vh] rounded-lg">
                </div>
            `;
            document.body.appendChild(modal);
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        };

        // Show report content
        document.getElementById('loadingState').classList.add('hidden');
        document.getElementById('reportContent').classList.remove('hidden');

        // Setup public toggle (only show if user owns the report)
        const currentUserEmail = window.currentUserEmail;
        if (currentUserEmail && report.userEmail === currentUserEmail) {
            const toggleContainer = document.getElementById('publicToggleContainer');
            const publicToggle = document.getElementById('publicToggle');
            
            if (toggleContainer && publicToggle) {
                toggleContainer.classList.remove('hidden');
                publicToggle.checked = report.isPublic || false;
                
                // Handle toggle change
                publicToggle.addEventListener('change', function() {
                    const isPublic = publicToggle.checked;
                    reportManager.updateReport(reportId, { isPublic: isPublic });
                    
                    // Show feedback
                    const feedback = document.createElement('div');
                    feedback.className = 'fixed top-20 right-4 bg-white border border-gray-200 rounded-lg shadow-lg px-4 py-3 z-50';
                    feedback.innerHTML = `
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-900">${isPublic ? 'Report is now public' : 'Report is now private'}</span>
                        </div>
                    `;
                    document.body.appendChild(feedback);
                    
                    setTimeout(() => {
                        feedback.style.opacity = '0';
                        feedback.style.transition = 'opacity 0.3s';
                        setTimeout(() => feedback.remove(), 300);
                    }, 2000);
                });
            }
        }
    }

    // Load and display chat messages
    function loadChatMessages() {
        const messages = reportManager.getChatMessages(reportId);
        const chatContainer = document.getElementById('chatMessages');

        if (messages.length === 0) {
            chatContainer.innerHTML = `
                <div class="text-center text-gray-500 text-sm py-8">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p>No messages yet. Start the conversation!</p>
                </div>
            `;
            return;
        }

        chatContainer.innerHTML = messages.map(msg => {
            const isEmployee = msg.senderType === 'employee';
            const timeAgo = reportManager.formatDate(msg.timestamp);
            
            let attachmentsHtml = '';
            if (msg.attachments && msg.attachments.length > 0) {
                attachmentsHtml = '<div class="mt-2 space-y-2">' + msg.attachments.map(att => {
                    if (att.type && att.type.startsWith('image/')) {
                        return `
                            <div class="rounded-lg overflow-hidden border ${isEmployee ? 'border-gray-300' : 'border-white/30'}">
                                <img src="${att.data}" alt="${att.name || 'Image'}" class="max-w-full max-h-48 cursor-pointer" onclick="openImageModal('${att.data}', '${att.name || 'Image'}')">
                            </div>
                        `;
                    } else {
                        return `
                            <div class="flex items-center gap-2 p-2 ${isEmployee ? 'bg-gray-100' : 'bg-white/10'} rounded">
                                <svg class="w-4 h-4 ${isEmployee ? 'text-gray-600' : 'text-white'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-xs ${isEmployee ? 'text-gray-700' : 'text-white'} truncate flex-1">${att.name || 'File'}</span>
                                <a href="${att.data}" download="${att.name || 'file'}" class="text-xs ${isEmployee ? 'text-[#65B741] hover:text-[#4d8a32]' : 'text-white/80 hover:text-white'} font-semibold">Download</a>
                            </div>
                        `;
                    }
                }).join('') + '</div>';
            }
            
            return `
                <div class="flex ${isEmployee ? 'justify-start' : 'justify-end'}">
                    <div class="max-w-[80%] ${isEmployee ? 'bg-white border border-gray-200' : 'bg-[#65B741] text-white'} rounded-lg px-4 py-2 shadow-sm">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold ${isEmployee ? 'text-gray-700' : 'text-white/90'}">${msg.senderName}</span>
                            <span class="text-xs ${isEmployee ? 'text-gray-500' : 'text-white/70'}">${timeAgo}</span>
                        </div>
                        ${msg.message ? `<p class="text-sm ${isEmployee ? 'text-gray-900' : 'text-white'}">${msg.message}</p>` : ''}
                        ${attachmentsHtml}
                    </div>
                </div>
            `;
        }).join('');

        // Scroll to bottom
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Chat file handling
    let chatFiles = [];
    const chatFileInput = document.getElementById('chatFileInput');
    const chatFilePreview = document.getElementById('chatFilePreview');
    const chatFileList = document.getElementById('chatFileList');

    if (chatFileInput) {
        chatFileInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            chatFiles = [...chatFiles, ...files];
            updateChatFilePreview();
        });
    }

    function updateChatFilePreview() {
        if (chatFiles.length === 0) {
            chatFilePreview.classList.add('hidden');
            return;
        }

        chatFilePreview.classList.remove('hidden');
        chatFileList.innerHTML = '';

        chatFiles.forEach((file, index) => {
            const fileDiv = document.createElement('div');
            fileDiv.className = 'flex items-center gap-2 bg-gray-100 rounded-lg p-2 text-xs';
            
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    fileDiv.innerHTML = `
                        <img src="${e.target.result}" alt="${file.name}" class="w-8 h-8 object-cover rounded">
                        <span class="text-gray-700 truncate max-w-[100px]">${file.name}</span>
                        <button type="button" onclick="removeChatFile(${index})" class="text-red-600 hover:text-red-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    `;
                };
                reader.readAsDataURL(file);
            } else {
                fileDiv.innerHTML = `
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-gray-700 truncate max-w-[100px]">${file.name}</span>
                    <button type="button" onclick="removeChatFile(${index})" class="text-red-600 hover:text-red-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
            }
            
            chatFileList.appendChild(fileDiv);
        });
    }

    window.removeChatFile = function(index) {
        chatFiles.splice(index, 1);
        const dt = new DataTransfer();
        chatFiles.forEach(file => dt.items.add(file));
        chatFileInput.files = dt.files;
        updateChatFilePreview();
    };

    window.clearChatFiles = function() {
        chatFiles = [];
        chatFileInput.value = '';
        updateChatFilePreview();
    };

    // Handle chat form submission
    const chatForm = document.getElementById('chatForm');
    if (chatForm) {
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const input = document.getElementById('chatInput');
            const message = input.value.trim();

            if (message || chatFiles.length > 0) {
                const senderType = window.currentUserRole === 'employee' ? 'employee' : 'user';
                
                // Convert files to base64
                if (chatFiles.length > 0) {
                    const filePromises = chatFiles.map(file => {
                        return new Promise((resolve) => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                resolve({
                                    name: file.name,
                                    type: file.type,
                                    size: file.size,
                                    data: e.target.result
                                });
                            };
                            reader.readAsDataURL(file);
                        });
                    });

                    Promise.all(filePromises).then(attachments => {
                        reportManager.saveChatMessage(reportId, message || '', senderType, attachments);
                        input.value = '';
                        clearChatFiles();
                        loadChatMessages();
                    });
                } else {
                    reportManager.saveChatMessage(reportId, message, senderType, []);
                    input.value = '';
                    loadChatMessages();
                }
            }
        });
    }

    // Initial load
    loadReport();
    loadChatMessages();

    // Auto-refresh chat messages every 2 seconds (simulated real-time)
    chatRefreshInterval = setInterval(loadChatMessages, 2000);

    // Cleanup on page unload
    window.addEventListener('beforeunload', function() {
        if (chatRefreshInterval) {
            clearInterval(chatRefreshInterval);
        }
    });
});
</script>
@endsection
