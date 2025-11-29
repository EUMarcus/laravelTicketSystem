@extends('layouts.app')

@section('title', 'Suggestion Details - Community Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6" data-aos="fade-down">
        <a href="{{ route('suggestions.index') }}" class="inline-flex items-center space-x-2 text-text-secondary hover:text-primary transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Suggestions</span>
        </a>
    </div>

    <div class="modern-card p-6 lg:p-8 mb-6" data-aos="fade-up">
        <div class="mb-6">
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-green-light-bg text-primary mb-4 inline-block">
                Health
            </span>
            <h1 class="text-3xl font-bold text-text-primary mb-4">Weekly Community Exercise Program</h1>
            <div class="flex items-center text-sm text-text-muted mb-6">
                <span>By Maria Santos</span>
                <span class="mx-2">•</span>
                <span>3 days ago</span>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-text-primary mb-3">Description</h3>
            <p class="text-text-secondary leading-relaxed">
                I suggest organizing a weekly community exercise program in the barangay park. This would include Zumba, yoga, or simple aerobics sessions every Saturday morning. This will help promote health and wellness among residents, especially seniors and stay-at-home parents. We can invite volunteer instructors or partner with fitness professionals in our community.
            </p>
        </div>

        <div class="flex items-center gap-6 border-t border-gray-200 pt-6">
            <button class="flex items-center space-x-2 px-6 py-3 bg-accent-green-light-bg text-primary rounded-lg hover:bg-accent-green-light transition-colors border border-primary-lighter">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                </svg>
                <span class="font-semibold">45 Upvotes</span>
            </button>
            <div class="flex items-center space-x-2 text-text-muted">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span>12 Comments</span>
            </div>
        </div>
    </div>
</div>
@endsection

