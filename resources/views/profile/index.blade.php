@extends('layouts.app')

@section('title', 'My Profile - Community Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8" data-aos="fade-down">
        <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">My Profile</h1>
        <p class="text-text-secondary">View your community engagement</p>
    </div>

    <div class="modern-card p-6 lg:p-8 mb-6" data-aos="fade-up">
        <div class="flex items-center space-x-6 mb-6">
            <div class="w-24 h-24 bg-primary-lighter rounded-full flex items-center justify-center">
                <span class="text-3xl font-bold text-primary">JS</span>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-text-primary mb-1">Juan Santos</h2>
                <p class="text-text-secondary mb-2">Block 5, Main Street</p>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-success-light text-success">Verified Resident</span>
            </div>
        </div>
        <div class="grid md:grid-cols-3 gap-4 border-t border-gray-200 pt-6">
            <div>
                <p class="text-sm text-text-muted mb-1">Email</p>
                <p class="font-semibold text-text-primary">juan.santos@email.com</p>
            </div>
            <div>
                <p class="text-sm text-text-muted mb-1">Contact</p>
                <p class="font-semibold text-text-primary">0912-345-6789</p>
            </div>
            <div>
                <p class="text-sm text-text-muted mb-1">Member Since</p>
                <p class="font-semibold text-text-primary">January 2024</p>
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="modern-card p-6" data-aos="fade-right">
            <h3 class="text-xl font-bold text-text-primary mb-4">My Reports</h3>
            <div class="space-y-3">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p class="font-semibold text-text-primary text-sm">Broken Streetlight</p>
                    <p class="text-xs text-text-muted">Status: In Progress</p>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p class="font-semibold text-text-primary text-sm">Pothole Report</p>
                    <p class="text-xs text-text-muted">Status: Completed</p>
                </div>
            </div>
            <a href="{{ route('reports.index') }}" class="block mt-4 text-center text-primary hover:text-primary-dark font-semibold">View All →</a>
        </div>

        <div class="modern-card p-6" data-aos="fade-left">
            <h3 class="text-xl font-bold text-text-primary mb-4">My Suggestions</h3>
            <div class="space-y-3">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p class="font-semibold text-text-primary text-sm">Community Garden</p>
                    <p class="text-xs text-text-muted">45 upvotes</p>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p class="font-semibold text-text-primary text-sm">Exercise Program</p>
                    <p class="text-xs text-text-muted">23 upvotes</p>
                </div>
            </div>
            <a href="{{ route('suggestions.index') }}" class="block mt-4 text-center text-primary hover:text-primary-dark font-semibold">View All →</a>
        </div>
    </div>
</div>
@endsection

