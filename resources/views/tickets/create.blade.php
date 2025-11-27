@extends('layouts.app')

@section('title', 'Create Ticket - Kampay Tickets')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-kampay-text-warm dark:text-white">Create New Ticket</h1>
        <p class="text-kampay-text-muted mt-2">Submit a support request and we'll get back to you</p>
    </div>

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
                <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-kampay-teal transition">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-kampay-text-muted" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-kampay-text-muted">
                            <label for="attachments" class="relative cursor-pointer bg-white dark:bg-kampay-bg-dark rounded-md font-medium text-kampay-teal hover:text-kampay-teal-dark focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-kampay-teal">
                                <span>Upload files</span>
                                <input id="attachments" name="attachments[]" type="file" multiple class="sr-only" accept="image/*,application/pdf,.doc,.docx">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-kampay-text-muted">PNG, JPG, PDF up to 10MB</p>
                    </div>
                </div>
                <div id="file-list" class="mt-4"></div>
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
    document.getElementById('attachments').addEventListener('change', function(e) {
        const fileList = document.getElementById('file-list');
        fileList.innerHTML = '';
        
        Array.from(e.target.files).forEach(file => {
            const div = document.createElement('div');
            div.className = 'flex items-center justify-between p-2 bg-kampay-teal-light rounded mb-2';
            div.innerHTML = `
                <span class="text-sm text-kampay-teal-dark">${file.name}</span>
                <span class="text-xs text-kampay-text-muted">${(file.size / 1024).toFixed(2)} KB</span>
            `;
            fileList.appendChild(div);
        });
    });
</script>
@endsection


