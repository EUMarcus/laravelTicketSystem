@extends('layouts.app')

@section('title', 'Report Details - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('reports.my-reports') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-medium">Back to My Reports</span>
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
                        <div class="flex items-center gap-2 flex-wrap mb-4">
                            <span id="reportCategory" class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200"></span>
                            <span id="reportStatus" class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium"></span>
                            <span id="reportPriority" class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium"></span>
                            <span id="reportTicketId" class="text-gray-400 font-mono text-xs"></span>
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
                    <a href="{{ route('reports.my-reports') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                        <span>Back to My Reports</span>
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
                        <form id="chatForm" class="space-y-3">
                            <!-- File Upload Button -->
                            <div class="flex items-center gap-2">
                                <label for="chatFileInput" class="cursor-pointer p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                </label>
                                <input type="file" id="chatFileInput" multiple accept="image/*,.pdf,.doc,.docx" class="hidden">
                                <div id="chatFilePreview" class="flex-1 flex items-center gap-2 flex-wrap"></div>
                            </div>
                            
                            <!-- Message Input -->
                            <div class="flex gap-2">
                                <input type="text" id="chatInput" placeholder="Type your message..." class="flex-1 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-[#65B741] outline-none" required>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reportManager = new ReportManager();
    const reportId = '{{ $id }}';
    let chatRefreshInterval;
    let selectedChatFiles = [];

    // Load and display report
    function loadReport() {
        const report = reportManager.getReportById(reportId);
        
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
        
        // Show report content
        document.getElementById('loadingState').classList.add('hidden');
        document.getElementById('reportContent').classList.remove('hidden');
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
            const isUser = msg.senderType === 'user';
            const timeAgo = reportManager.formatDate(msg.timestamp);
            
            let attachmentsHtml = '';
            if (msg.attachments && msg.attachments.length > 0) {
                attachmentsHtml = msg.attachments.map(att => {
                    if (att.type && att.type.startsWith('image/')) {
                        return `
                            <div class="mt-2">
                                <img src="${att.data}" alt="${att.name}" class="max-w-full max-h-32 rounded-lg cursor-pointer" onclick="openImageModal('${att.data}', '${att.name}')">
                                <p class="text-xs ${isUser ? 'text-white/70' : 'text-gray-500'} mt-1">${att.name}</p>
                            </div>
                        `;
                    } else {
                        return `
                            <div class="mt-2 flex items-center gap-2 ${isUser ? 'bg-white/20' : 'bg-gray-100'} p-2 rounded">
                                <svg class="w-4 h-4 ${isUser ? 'text-white' : 'text-gray-600'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-xs ${isUser ? 'text-white' : 'text-gray-700'}">${att.name}</span>
                                <a href="${att.data}" download="${att.name}" class="ml-auto">
                                    <svg class="w-4 h-4 ${isUser ? 'text-white' : 'text-gray-600'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>
                            </div>
                        `;
                    }
                }).join('');
            }
            
            return `
                <div class="flex ${isUser ? 'justify-end' : 'justify-start'}">
                    <div class="max-w-[80%] ${isUser ? 'bg-[#65B741] text-white' : 'bg-white border border-gray-200'} rounded-lg px-4 py-2 shadow-sm">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold ${isUser ? 'text-white/90' : 'text-gray-700'}">${msg.senderName}</span>
                            <span class="text-xs ${isUser ? 'text-white/70' : 'text-gray-500'}">${timeAgo}</span>
                        </div>
                        ${msg.message ? `<p class="text-sm ${isUser ? 'text-white' : 'text-gray-900'}">${msg.message}</p>` : ''}
                        ${attachmentsHtml}
                    </div>
                </div>
            `;
        }).join('');

        // Scroll to bottom
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // File upload handling
    const chatFileInput = document.getElementById('chatFileInput');
    const chatFilePreview = document.getElementById('chatFilePreview');
    
    if (chatFileInput) {
        chatFileInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            selectedChatFiles = files;
            updateChatFilePreview();
        });
    }

    function updateChatFilePreview() {
        chatFilePreview.innerHTML = '';
        
        selectedChatFiles.forEach((file, index) => {
            const fileDiv = document.createElement('div');
            fileDiv.className = 'flex items-center gap-2 bg-gray-100 px-2 py-1 rounded text-xs';
            
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    fileDiv.innerHTML = `
                        <img src="${e.target.result}" alt="${file.name}" class="w-8 h-8 object-cover rounded">
                        <span class="text-gray-700 truncate max-w-[100px]">${file.name}</span>
                        <button type="button" onclick="removeChatFile(${index})" class="text-red-500 hover:text-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    `;
                    chatFilePreview.appendChild(fileDiv);
                };
                reader.readAsDataURL(file);
            } else {
                fileDiv.innerHTML = `
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-gray-700 truncate max-w-[100px]">${file.name}</span>
                    <button type="button" onclick="removeChatFile(${index})" class="text-red-500 hover:text-red-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                chatFilePreview.appendChild(fileDiv);
            }
        });
    }

    window.removeChatFile = function(index) {
        selectedChatFiles.splice(index, 1);
        const dt = new DataTransfer();
        selectedChatFiles.forEach(file => dt.items.add(file));
        chatFileInput.files = dt.files;
        updateChatFilePreview();
    };

    // Handle chat form submission
    const chatForm = document.getElementById('chatForm');
    if (chatForm) {
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const input = document.getElementById('chatInput');
            const message = input.value.trim();

            if (message || selectedChatFiles.length > 0) {
                // Convert files to base64
                if (selectedChatFiles.length > 0) {
                    const filePromises = Array.from(selectedChatFiles).map(file => {
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
                        sendMessage(message, attachments);
                    });
                } else {
                    sendMessage(message, []);
                }
            }
        });
    }

    function sendMessage(messageText, attachments) {
        const senderType = window.currentUserRole === 'employee' ? 'employee' : 'user';
        
        // Save message with attachments using ReportManager
        reportManager.saveChatMessage(reportId, messageText, senderType, attachments);

        // Clear input and files
        document.getElementById('chatInput').value = '';
        selectedChatFiles = [];
        chatFileInput.value = '';
        updateChatFilePreview();
        
        // Reload messages
        loadChatMessages();
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
@endif
@endsection

