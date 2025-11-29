@extends('layouts.app')

@section('title', 'Create Report - Community Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-8">
        <div class="mb-6">
            <a href="{{ route('reports.index') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="font-medium">Back to Reports</span>
            </a>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Create New Report</h1>
            <p class="text-lg text-gray-600">Submit a report about community issues</p>
        </div>
    </div>

    <!-- Login Required Notice -->
    <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm text-center">
        <div class="max-w-md mx-auto">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-[#65B741]/10 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Login Required</h3>
            <p class="text-gray-600 mb-6">You need to be logged in to submit a report. This helps us track and respond to your concerns effectively.</p>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('login') }}" class="px-8 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800">
                    Login
                </a>
                <a href="{{ route('register') }}" class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50">
                    Register
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card - Hidden until logged in -->
    <div class="bg-white p-6 lg:p-8 rounded-lg border border-gray-200 shadow-sm hidden">
        <form class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                <select class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" required>
                    <option value="">Select Category</option>
                    <option value="road">Road Issues (potholes, cracks)</option>
                    <option value="flooding">Flooding/Drainage Problems</option>
                    <option value="streetlights">Broken Streetlights</option>
                    <option value="garbage">Garbage/Cleanliness Issues</option>
                    <option value="noise">Noise Complaints</option>
                    <option value="safety">Safety/Security Concerns</option>
                    <option value="lost">Lost & Found</option>
                    <option value="animals">Stray Animals</option>
                    <option value="other">Other Community Issues</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                <input type="text" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none" placeholder="Brief description of the issue" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea rows="6" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none" placeholder="Provide more details about the issue..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                <input type="text" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none" placeholder="Street name, block, or landmark">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Map Link <span class="text-gray-400 font-normal">(Optional)</span></label>
                <input type="url" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none" placeholder="https://maps.google.com/...">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Photo Upload</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-gray-400 transition-colors bg-gray-50">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-600 mb-2 font-medium">Click to upload or drag and drop</p>
                    <p class="text-sm text-gray-500">PNG, JPG up to 10MB</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Priority</label>
                    <select class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white">
                        <option value="low">Low</option>
                        <option value="normal" selected>Normal</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                        <span class="ml-2 text-sm text-gray-700">Submit as Anonymous</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('reports.index') }}" class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 flex-1">
                    Submit Report
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
