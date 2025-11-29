@extends('layouts.app')

@section('title', 'Create Suggestion - Community Hub')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8" data-aos="fade-down">
        <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">Share Your Suggestion</h1>
        <p class="text-text-secondary">Help improve our community with your ideas</p>
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
                <p class="text-text-secondary text-sm mb-4">You need to be logged in to submit suggestions. This ensures community members can engage with your ideas.</p>
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
                <label class="block text-sm font-semibold text-text-primary mb-2">Category (Optional)</label>
                <select class="modern-input">
                    <option value="">Select Category</option>
                    <option>New Programs/Activities</option>
                    <option>Cleanliness & Beautification</option>
                    <option>Festivals & Cultural Events</option>
                    <option>Safety Improvements</option>
                    <option>Youth Programs</option>
                    <option>Sports Events</option>
                    <option>Education Initiatives</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Title <span class="text-error">*</span></label>
                <input type="text" class="modern-input" placeholder="Brief title for your suggestion" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-text-primary mb-2">Description <span class="text-error">*</span></label>
                <textarea rows="8" class="modern-input resize-none" placeholder="Describe your suggestion in detail..." required></textarea>
            </div>

            <div class="flex items-center">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                    <span class="ml-2 text-sm text-text-secondary">Submit as Anonymous</span>
                </label>
            </div>

            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('suggestions.index') }}" class="px-6 py-3 border-2 border-gray-300 rounded-lg text-text-secondary font-semibold hover:bg-gray-50 transition-all">Cancel</a>
                <button type="submit" class="btn-primary px-8 py-3 rounded-lg font-semibold flex-1">Submit Suggestion</button>
            </div>
        </form>
    </div>
</div>
@endsection

