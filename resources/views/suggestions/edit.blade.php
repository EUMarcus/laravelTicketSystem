@extends('layouts.app')

@section('title', 'Edit Suggestion - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <div class="mb-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Edit Suggestion</h1>
                <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Update suggestion details</p>
            </div>
            <a href="{{ route('staff.suggestions') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Suggestions</span>
            </a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Edit Suggestion</h2>
            
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('suggestions.update', $suggestion['suggest_id']) }}" class="space-y-5">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $suggestion['title']) }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Category</label>
                    <select name="category" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white">
                        <option value="">Select Category</option>
                        <option value="Health" {{ old('category', $suggestion['category']) == 'Health' ? 'selected' : '' }}>Health</option>
                        <option value="Infrastructure" {{ old('category', $suggestion['category']) == 'Infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                        <option value="Events" {{ old('category', $suggestion['category']) == 'Events' ? 'selected' : '' }}>Events</option>
                        <option value="Education" {{ old('category', $suggestion['category']) == 'Education' ? 'selected' : '' }}>Education</option>
                        <option value="Environment" {{ old('category', $suggestion['category']) == 'Environment' ? 'selected' : '' }}>Environment</option>
                        <option value="Sports" {{ old('category', $suggestion['category']) == 'Sports' ? 'selected' : '' }}>Sports</option>
                        <option value="Safety" {{ old('category', $suggestion['category']) == 'Safety' ? 'selected' : '' }}>Safety</option>
                        <option value="Other" {{ old('category', $suggestion['category']) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="8" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none bg-white" required>{{ old('description', $suggestion['full_content']) }}</textarea>
                </div>

                <div class="flex gap-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('staff.suggestions') }}" class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 flex-1">
                        Update Suggestion
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

