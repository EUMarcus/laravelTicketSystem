@extends('layouts.app')

@section('title', 'Submit Report - Community Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Submit Report</h1>
                <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Report community issues and track their resolution</p>
            </div>
            <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Reports</span>
            </a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <!-- Main Content - Report Form -->
        <div>
            @if(!session('user'))
                <!-- Login Required Notice -->
                <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm text-center mb-6">
                    <div class="max-w-md mx-auto">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-[#65B741]/10 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Login Required</h3>
                        <p class="text-gray-600 mb-6">You need to be logged in to submit a report. This helps us track and respond to your concerns effectively.</p>
                        <div class="flex gap-3 justify-center">
                            <a href="{{ route('login') }}" class="px-8 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50">
                                Register
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Report Form -->
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Create New Report</h2>
                    <form id="reportForm" class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Category <span class="text-red-500">*</span></label>
                            <select id="reportCategory" name="category" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" required>
                                <option value="">Select Category</option>
                                <option value="Road Issues">Road Issues (potholes, cracks)</option>
                                <option value="Flooding/Drainage">Flooding/Drainage Problems</option>
                                <option value="Broken Streetlights">Broken Streetlights</option>
                                <option value="Garbage/Cleanliness">Garbage/Cleanliness Issues</option>
                                <option value="Noise Complaints">Noise Complaints</option>
                                <option value="Safety/Security">Safety/Security Concerns</option>
                                <option value="Lost & Found">Lost & Found</option>
                                <option value="Stray Animals">Stray Animals</option>
                                <option value="Other">Other Community Issues</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Title <span class="text-red-500">*</span></label>
                            <input type="text" id="reportTitle" name="title" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="Brief description of the issue" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Description</label>
                            <textarea id="reportDescription" name="description" rows="5" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none bg-white" placeholder="Provide more details about the issue..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Location</label>
                            <input type="text" id="reportLocation" name="location" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="Street name, block, or landmark">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Photos/Attachments</label>
                            <div id="photoUploadArea" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors bg-gray-50 cursor-pointer">
                                <input type="file" id="reportPhotos" name="photos[]" accept="image/*,.pdf,.doc,.docx" multiple class="hidden">
                                <svg class="w-10 h-10 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-600 mb-1 font-medium text-sm">Click to upload or drag and drop</p>
                                <p class="text-xs text-gray-500">Images, PDF, DOC up to 10MB each</p>
                                <p class="text-xs text-gray-400 mt-1">You can upload multiple files</p>
                                <div id="photoPreview" class="hidden mt-4">
                                    <div id="photoPreviewGrid" class="grid grid-cols-2 md:grid-cols-3 gap-3"></div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Priority</label>
                            <select id="reportPriority" name="priority" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white">
                                <option value="Low">Low</option>
                                <option value="Normal" selected>Normal</option>
                                <option value="High">High</option>
                            </select>
                        </div>

                        <div class="flex gap-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('reports.index') }}" class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 flex-1">
                                Submit Report
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Subject <span class="text-red-500">*</span></label>
                <input type="text" name="subject" value="{{ old('subject') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="Brief description of the issue" required>
                @error('subject')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Priority <span class="text-red-500">*</span></label>
                <select name="priority" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" required>
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low - General inquiry</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium - Normal request</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High - Urgent matter</option>
                    <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent - Immediate attention needed</option>
                </select>
                @error('priority')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Description</label>
                <textarea name="description" rows="5" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none bg-white" placeholder="Provide more details about the issue...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Attachments <span class="text-gray-500 font-normal">(Optional)</span></label>
                <div class="relative">
                    <input id="attachments" name="attachments[]" type="file" multiple class="hidden" accept="image/*,application/pdf,.doc,.docx" onchange="displayFileList(this.files)">
                    <label for="attachments" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-[#65B741] hover:bg-[#65B741]/10 transition-all duration-200 group">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-[#65B741] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-600">
                                <span class="font-semibold text-[#65B741]">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-gray-500">PNG, JPG, PDF, DOC up to 10MB each</p>
                        </div>
                    </label>
                </div>
                <div id="file-list" class="mt-4 space-y-2"></div>
                @error('attachments.*')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-200">
                <a href="{{ route('reports.index') }}" class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 flex-1">
                    Submit Report
                </button>
            </div>
        </form>
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
    const form = document.getElementById('reportForm');
    const photoUploadArea = document.getElementById('photoUploadArea');
    const photoInput = document.getElementById('reportPhotos');
    const photoPreview = document.getElementById('photoPreview');
    const photoPreviewGrid = document.getElementById('photoPreviewGrid');
    let selectedFiles = [];

    // Photo upload preview
    photoUploadArea.addEventListener('click', () => photoInput.click());
    
    photoInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        selectedFiles = files;
        updatePreview();
    });

    function updatePreview() {
        photoPreviewGrid.innerHTML = '';
        
        if (selectedFiles.length === 0) {
            photoPreview.classList.add('hidden');
            return;
        }

        photoPreview.classList.remove('hidden');
        
        selectedFiles.forEach((file, index) => {
            const fileDiv = document.createElement('div');
            fileDiv.className = 'relative group';
            
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    fileDiv.innerHTML = `
                        <div class="relative">
                            <img src="${e.target.result}" alt="Preview" class="w-full h-24 object-cover rounded-lg border border-gray-200">
                            <button type="button" onclick="removeFile(${index})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-600 mt-1 truncate" title="${file.name}">${file.name}</p>
                    `;
                    photoPreviewGrid.appendChild(fileDiv);
                };
                reader.readAsDataURL(file);
            } else {
                fileDiv.innerHTML = `
                    <div class="relative">
                        <div class="w-full h-24 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <button type="button" onclick="removeFile(${index})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-600 mt-1 truncate" title="${file.name}">${file.name}</p>
                `;
                photoPreviewGrid.appendChild(fileDiv);
            }
        });
    }

    window.removeFile = function(index) {
        selectedFiles.splice(index, 1);
        
        // Update the file input
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        photoInput.files = dt.files;
        
        updatePreview();
    };

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const reportManager = new ReportManager();
        
        // Get form data
        const category = document.getElementById('reportCategory').value;
        const title = document.getElementById('reportTitle').value;
        const description = document.getElementById('reportDescription').value;
        const location = document.getElementById('reportLocation').value;
        const priority = document.getElementById('reportPriority').value;
        
        // Convert all files to base64
        if (selectedFiles.length > 0) {
            const filePromises = Array.from(selectedFiles).map(file => {
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

            Promise.all(filePromises).then(filesData => {
                submitReport(filesData);
            });
        } else {
            submitReport([]);
        }

        function submitReport(filesData) {
            const reportData = {
                category: category,
                title: title,
                description: description,
                location: location,
                priority: priority,
                photos: filesData
            };

            const newReport = reportManager.saveReport(reportData);
            
            // Redirect to report details page
            window.location.href = `/reports/${newReport.id}`;
        }
    });
});
</script>
@endif
@endsection
