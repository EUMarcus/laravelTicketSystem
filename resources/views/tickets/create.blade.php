@extends('layouts.app')

@section('title', 'Create Ticket - Kampay Tickets')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-kampay-text-warm dark:text-white">Create New Ticket</h1>
        <p class="text-kampay-text-muted mt-2">Submit a support request and we'll get back to you</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-kampay-red-light border border-kampay-red rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-kampay-red" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-kampay-red-dark">Upload Error</h3>
                    <div class="mt-2 text-sm text-kampay-red-dark">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white dark:bg-kampay-bg-darker rounded-2xl shadow-xl p-8 kampay-splash">
        <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="subject" class="block text-sm font-medium text-kampay-text-warm dark:text-white mb-2">
                    Subject <span class="text-kampay-red">*</span>
                </label>
                <input 
                    id="subject" 
                    type="text" 
                    name="subject" 
                    value="{{ old('subject') }}" 
                    required 
                    autofocus
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-kampay-bg-dark focus:ring-2 focus:ring-kampay-teal focus:border-transparent dark:bg-kampay-bg-dark dark:text-white"
                    placeholder="Brief description of your issue"
                >
            </div>

            <div class="mb-6">
                <label for="priority" class="block text-sm font-medium text-kampay-text-warm dark:text-white mb-2">
                    Priority <span class="text-kampay-red">*</span>
                </label>
                <select 
                    id="priority" 
                    name="priority" 
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-kampay-bg-dark focus:ring-2 focus:ring-kampay-teal focus:border-transparent dark:bg-kampay-bg-dark dark:text-white"
                >
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-kampay-text-warm dark:text-white mb-2">
                    Description
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="6"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-kampay-bg-dark focus:ring-2 focus:ring-kampay-teal focus:border-transparent dark:bg-kampay-bg-dark dark:text-white"
                    placeholder="Provide more details about your issue..."
                >{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="attachments" class="block text-sm font-medium text-kampay-text-warm dark:text-white mb-2">
                    Attachments (Optional)
                </label>
                <div id="drop-zone" class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-kampay-teal transition cursor-pointer">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-kampay-text-muted" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-kampay-text-muted justify-center">
                            <span class="font-medium text-kampay-teal hover:text-kampay-teal-dark">Click to browse</span>
                            <span class="pl-1">or drag and drop</span>
                        </div>
                        <p class="text-xs text-kampay-text-muted">PNG, JPG, PDF up to 10MB</p>
                    </div>
                </div>
                <input id="attachments" name="attachments[]" type="file" multiple class="hidden" accept="image/*,application/pdf,.doc,.docx">
                <div id="file-list" class="mt-4 flex flex-wrap gap-2"></div>
            </div>

            <div class="flex justify-end space-x-4">
                <a 
                    href="{{ route('tickets.index') }}" 
                    class="px-6 py-3 border border-gray-300 dark:border-kampay-bg-dark rounded-lg text-kampay-text-warm dark:text-white hover:bg-gray-50 dark:hover:bg-kampay-bg-dark transition"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-gradient-to-r from-kampay-teal to-kampay-teal-dark hover:from-kampay-teal-dark hover:to-kampay-teal text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105"
                >
                    Create Ticket
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('attachments');
    const fileList = document.getElementById('file-list');

    // Click to browse
    dropZone.addEventListener('click', function() {
        fileInput.click();
    });

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop zone when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropZone.classList.add('border-kampay-teal', 'bg-kampay-teal-light');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-kampay-teal', 'bg-kampay-teal-light');
    }

    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        handleFiles(files);
    }

    // Handle file input change (from click)
    fileInput.addEventListener('change', function(e) {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        fileList.innerHTML = '';
        
        Array.from(files).forEach(file => {
            // Check file size (10MB = 10485760 bytes)
            if (file.size > 10485760) {
                alert(`File "${file.name}" is too large. Maximum size is 10MB.`);
                return;
            }

            const badge = document.createElement('div');
            badge.className = 'inline-flex items-center space-x-2 px-3 py-1 bg-kampay-teal-light dark:bg-kampay-bg-dark rounded-lg text-sm';
            badge.innerHTML = `
                <svg class="w-4 h-4 text-kampay-teal-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <span class="text-kampay-teal-dark dark:text-white">${file.name}</span>
                <span class="text-xs text-kampay-text-muted">(${(file.size / 1024).toFixed(1)} KB)</span>
            `;
            fileList.appendChild(badge);
        });
    }
</script>
@endsection


