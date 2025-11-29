@extends('layouts.app')

@section('title', 'Create Ticket - Community Hub')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8" data-aos="fade-down">
        <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">Create New Ticket</h1>
        <p class="text-text-secondary">Submit a support request and we'll get back to you as soon as possible</p>
    </div>

    <!-- Form Card -->
    <div class="modern-card p-8 lg:p-10" data-aos="fade-up">
        <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Subject -->
            <div>
                <label for="subject" class="block text-sm font-semibold text-text-primary mb-2">
                    Subject <span class="text-error">*</span>
                </label>
                <input 
                    id="subject" 
                    type="text" 
                    name="subject" 
                    value="{{ old('subject') }}" 
                    required 
                    autofocus
                    class="modern-input @error('subject') border-error @enderror"
                    placeholder="Brief description of your issue"
                >
                @error('subject')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Priority -->
            <div>
                <label for="priority" class="block text-sm font-semibold text-text-primary mb-2">
                    Priority <span class="text-error">*</span>
                </label>
                <select 
                    id="priority" 
                    name="priority" 
                    required
                    class="modern-input @error('priority') border-error @enderror"
                >
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low - General inquiry</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium - Normal request</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High - Urgent matter</option>
                    <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent - Immediate attention needed</option>
                </select>
                @error('priority')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-text-primary mb-2">
                    Description
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="6"
                    class="modern-input @error('description') border-error @enderror resize-none"
                    placeholder="Provide more details about your issue, what you've tried, and what you need help with..."
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Attachments -->
            <div>
                <label for="attachments" class="block text-sm font-semibold text-text-primary mb-2">
                    Attachments <span class="text-text-muted font-normal">(Optional)</span>
                </label>
                <div class="relative">
                    <input 
                        id="attachments" 
                        name="attachments[]" 
                        type="file" 
                        multiple 
                        class="hidden"
                        accept="image/*,application/pdf,.doc,.docx"
                        onchange="displayFileList(this.files)"
                    >
                    <label 
                        for="attachments" 
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-primary hover:bg-primary-lighter/10 transition-all duration-200 group"
                    >
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-text-muted group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                            <p class="mb-2 text-sm text-text-secondary">
                                <span class="font-semibold text-primary">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-text-muted">PNG, JPG, PDF, DOC up to 10MB each</p>
                        </div>
                    </label>
                </div>
                <div id="file-list" class="mt-4 space-y-2"></div>
                @error('attachments.*')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-gray-200">
                <a 
                    href="{{ route('tickets.index') }}" 
                    class="px-6 py-3 border-2 border-gray-300 rounded-lg text-text-secondary font-semibold text-center hover:bg-gray-50 hover:border-gray-400 transition-all duration-200"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="btn-primary px-8 py-3 rounded-lg font-semibold"
                >
                    Create Ticket
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function displayFileList(files) {
        const fileList = document.getElementById('file-list');
        fileList.innerHTML = '';
        
    if (files.length === 0) return;
    
    Array.from(files).forEach((file, index) => {
            const div = document.createElement('div');
        div.className = 'flex items-center justify-between p-3 bg-primary-lighter rounded-lg animate-fade-in';
            div.innerHTML = `
            <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-text-primary">${file.name}</p>
                    <p class="text-xs text-text-muted">${(file.size / 1024).toFixed(2)} KB</p>
                </div>
            </div>
            `;
            fileList.appendChild(div);
        });
}

// Enable drag and drop
const dropZone = document.querySelector('label[for="attachments"]');
const fileInput = document.getElementById('attachments');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dropZone.classList.add('border-primary', 'bg-primary-lighter/20');
}

function unhighlight(e) {
    dropZone.classList.remove('border-primary', 'bg-primary-lighter/20');
}

dropZone.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    fileInput.files = files;
    displayFileList(files);
}
</script>
@endsection
