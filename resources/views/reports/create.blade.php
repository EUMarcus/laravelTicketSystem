@extends('layouts.app')

@section('title', 'Create Report - Community Hub')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8" data-aos="fade-down">
        <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">Create New Report</h1>
        <p class="text-text-secondary">Submit a report about community issues</p>
    </div>

    <!-- Login Required Notice -->
    <div class="modern-card p-6 mb-6 bg-primary-lighter border-2 border-primary" data-aos="fade-up">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-text-primary mb-2">Login Required</h3>
                <p class="text-text-secondary text-sm mb-4">You need to be logged in to submit a report. This helps us track and respond to your concerns effectively.</p>
                <div class="flex gap-3">
                    <a href="{{ route('login') }}" class="btn-primary px-6 py-2 rounded-lg text-sm font-semibold">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-2 rounded-lg text-sm font-semibold border-2 border-primary text-primary hover:bg-primary-lighter transition-all">Register</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modern-card p-8 lg:p-10 opacity-60 pointer-events-none" data-aos="fade-up">
        <form class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Category <span class="text-error">*</span></label>
                <select class="modern-input" required>
                    <option value="">Select Category</option>
                    <option>Road Issues (potholes, cracks)</option>
                    <option>Flooding/Drainage Problems</option>
                    <option>Broken Streetlights</option>
                    <option>Garbage/Cleanliness Issues</option>
                    <option>Noise Complaints</option>
                    <option>Safety/Security Concerns</option>
                    <option>Lost & Found</option>
                    <option>Stray Animals</option>
                    <option>Other Community Issues</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Title <span class="text-error">*</span></label>
                <input type="text" class="modern-input" placeholder="Brief description of the issue" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Description</label>
                <textarea rows="6" class="modern-input resize-none" placeholder="Provide more details about the issue..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Location</label>
                <input type="text" class="modern-input" placeholder="Street name, block, or landmark">
            </div>

            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Map Link (Optional)</label>
                <input type="url" class="modern-input" placeholder="https://maps.google.com/...">
            </div>

            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Photo Upload</label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-primary transition-colors">
                    <svg class="w-12 h-12 mx-auto mb-4 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-text-secondary mb-2">Click to upload or drag and drop</p>
                    <p class="text-sm text-text-muted">PNG, JPG up to 10MB</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-text-primary mb-2">Priority</label>
                    <select class="modern-input">
                        <option>Low</option>
                        <option>Normal</option>
                        <option>High</option>
                    </select>
                </div>
                <div class="flex items-center pt-8">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                        <span class="ml-2 text-sm text-text-secondary">Submit as Anonymous</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('reports.index') }}" class="px-6 py-3 border-2 border-gray-300 rounded-lg text-text-secondary font-semibold hover:bg-gray-50 transition-all">Cancel</a>
                <button type="submit" class="btn-primary px-8 py-3 rounded-lg font-semibold flex-1">Submit Report</button>
            </div>
        </form>
    </div>
</div>
@endsection

