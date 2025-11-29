@extends('layouts.app')

@section('title', 'Poll Details - Community Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6" data-aos="fade-down">
        <a href="{{ route('polls.index') }}" class="inline-flex items-center space-x-2 text-text-secondary hover:text-primary transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Polls</span>
        </a>
    </div>

    <div class="modern-card p-6 lg:p-8" data-aos="fade-up">
        <div class="mb-6">
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-beige-light text-text-secondary mb-4 inline-block">
                Open
            </span>
            <h1 class="text-3xl font-bold text-text-primary mb-4">Preferred Day for Community Market</h1>
            <p class="text-text-secondary mb-4">Which day works best for a weekly community market?</p>
            <p class="text-sm text-text-muted">Deadline: December 15, 2024 • 234 votes</p>
        </div>

        <!-- Login Required Notice -->
        <div class="modern-card p-6 mb-6 bg-primary-lighter border-2 border-primary">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-text-primary mb-2">Login Required to Vote</h3>
                    <p class="text-text-secondary text-sm mb-4">You need to be logged in to participate in polls. This ensures one vote per resident and maintains fair voting.</p>
                    <div class="flex gap-3">
                        <a href="{{ route('login') }}" class="btn-primary px-6 py-2 rounded-lg text-sm font-semibold">Login</a>
                        <a href="{{ route('register') }}" class="px-6 py-2 rounded-lg text-sm font-semibold border-2 border-primary text-primary hover:bg-primary-lighter transition-all">Register</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4 opacity-60 pointer-events-none">
            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg transition-colors">
                <input type="radio" name="option" class="w-5 h-5 text-primary" disabled>
                <span class="ml-4 text-text-primary font-medium">Saturday Morning</span>
            </label>
            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg transition-colors">
                <input type="radio" name="option" class="w-5 h-5 text-primary" disabled>
                <span class="ml-4 text-text-primary font-medium">Sunday Morning</span>
            </label>
            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg transition-colors">
                <input type="radio" name="option" class="w-5 h-5 text-primary" disabled>
                <span class="ml-4 text-text-primary font-medium">Saturday Afternoon</span>
            </label>
            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg transition-colors">
                <input type="radio" name="option" class="w-5 h-5 text-primary" disabled>
                <span class="ml-4 text-text-primary font-medium">No Preference</span>
            </label>
        </div>

        <button class="btn-primary w-full mt-6 py-3 rounded-lg font-semibold opacity-60 cursor-not-allowed" disabled>Login to Vote</button>
    </div>
</div>
@endsection

