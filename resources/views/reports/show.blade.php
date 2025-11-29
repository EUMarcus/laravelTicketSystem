@extends('layouts.app')

@section('title', 'Report Details - Community Hub')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6" data-aos="fade-down">
        <a href="{{ route('reports.index') }}" class="inline-flex items-center space-x-2 text-text-secondary hover:text-primary transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Reports</span>
        </a>
    </div>

    <div class="modern-card p-6 lg:p-8 mb-6 border-l-4 border-primary" data-aos="fade-up">
        <div class="flex justify-between items-start mb-6">
            <div>
                <div class="flex items-center gap-3 mb-4 flex-wrap">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-beige-light text-text-secondary">Road Issues</span>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-tan-light text-accent-tan">In Progress</span>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-text-secondary">High</span>
                    <span class="text-sm text-text-muted">RPT-2024-001</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-text-primary mb-2">Broken Streetlight on Main Street</h1>
                <p class="text-text-secondary">Reported 2 days ago</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-text-primary mb-2">Description</h3>
            <p class="text-text-secondary leading-relaxed">Streetlight has been flickering for the past week and now completely out. Need immediate attention for safety of residents walking at night.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-6">
            <div>
                <h3 class="font-semibold text-text-primary mb-2">Location</h3>
                <p class="text-text-secondary">Main Street, Block 5</p>
            </div>
            <div>
                <h3 class="font-semibold text-text-primary mb-2">Contact</h3>
                <p class="text-text-secondary">Reported by: Resident</p>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <h3 class="font-semibold text-text-primary mb-4">Photo</h3>
            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800" alt="Report photo" class="rounded-lg w-full max-w-md">
        </div>
    </div>
</div>
@endsection

