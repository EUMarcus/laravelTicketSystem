@extends('layouts.app')

@section('title', 'Create Ticket - Kampay Tickets')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#2d3748] mb-2">Create New Ticket</h1>
        <p class="text-[#718096]">Submit a support request and we'll get back to you</p>
    </div>

    <div class="card card-elevated p-8 animate-fade-in">
        <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="subject" class="block text-sm font-semibold text-[#2d3748] mb-2">
                    Subject <span class="text-[#dc2626]">*</span>
                </label>
                <input 
                    id="subject" 
                    type="text" 
                    name="subject" 
                    value="{{ old('subject') }}" 
                    required 
                    autofocus
                    class="input-modern"
                    placeholder="Brief description of your issue"
                >
            </div>

            <div>
                <label for="priority" class="block text-sm font-semibold text-[#2d3748] mb-2">
                    Priority <span class="text-[#dc2626]">*</span>
                </label>
                <select 
                    id="priority" 
                    name="priority" 
                    required
                    class="input-modern"
                >
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-[#2d3748] mb-2">
                    Description
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="6"
                    class="input-modern resize-none"
                    placeholder="Provide more details about your issue..."
                >{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="attachments" class="block text-sm font-semibold text-[#2d3748] mb-2">
                    Attachments (Optional)
                </label>
                <div class="mt-2 flex justify-center px-6 pt-8 pb-8 border-2 border-dashed border-[#e2e8f0] rounded-modern hover:border-[#007E6E] transition bg-[#faf9f6]">
                    <div class="space-y-3 text-center">
                        <svg class="mx-auto h-12 w-12 text-[#718096]" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-[#718096] justify-center items-center gap-2">
                            <label for="attachments" class="relative cursor-pointer font-semibold text-[#007E6E] hover:text-[#005a4f] transition">
                                <span>Upload files</span>
                                <input id="attachments" name="attachments[]" type="file" multiple class="sr-only" accept="image/*,application/pdf,.doc,.docx">
                            </label>
                            <span>or drag and drop</span>
                        </div>
                        <p class="text-xs text-[#a0aec0]">PNG, JPG, PDF up to 10MB</p>
                    </div>
                </div>
                <div id="file-list" class="mt-4 space-y-2"></div>
            </div>

            <div class="flex justify-end gap-4 pt-4 border-t border-[#e2e8f0]">
                <a 
                    href="{{ route('tickets.index') }}" 
                    class="px-6 py-3 border border-[#e2e8f0] rounded-modern text-[#4a5568] hover:bg-[#f5f3ed] transition font-medium"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="btn-primary px-8 py-3"
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
            div.className = 'flex items-center justify-between p-3 bg-[#007E6E]/10 rounded-modern border border-[#007E6E]/20';
            div.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#007E6E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-sm font-medium text-[#2d3748]">${file.name}</span>
                </div>
                <span class="text-xs text-[#718096]">${(file.size / 1024).toFixed(2)} KB</span>
            `;
            fileList.appendChild(div);
        });
    });
</script>
@endsection
