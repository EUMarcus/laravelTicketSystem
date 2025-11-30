@extends('layouts.app')

@section('title', 'Edit Announcement - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <div class="mb-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Edit Announcement</h1>
                <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Update announcement details</p>
            </div>
            <a href="{{ route('staff.announcements') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Announcements</span>
            </a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Edit Announcement</h2>
            
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('announcements.update', $announcement['id']) }}" class="space-y-5">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $announcement['title']) }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Category <span class="text-red-500">*</span></label>
                    <select name="category" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" required>
                        <option value="Event" {{ old('category', $announcement['category']) == 'Event' ? 'selected' : '' }}>Event</option>
                        <option value="Health" {{ old('category', $announcement['category']) == 'Health' ? 'selected' : '' }}>Health</option>
                        <option value="Meeting" {{ old('category', $announcement['category']) == 'Meeting' ? 'selected' : '' }}>Meeting</option>
                        <option value="Service" {{ old('category', $announcement['category']) == 'Service' ? 'selected' : '' }}>Service</option>
                        <option value="Infrastructure" {{ old('category', $announcement['category']) == 'Infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                        <option value="Safety" {{ old('category', $announcement['category']) == 'Safety' ? 'selected' : '' }}>Safety</option>
                        <option value="Education" {{ old('category', $announcement['category']) == 'Education' ? 'selected' : '' }}>Education</option>
                        <option value="Other" {{ old('category', $announcement['category']) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Content <span class="text-red-500">*</span></label>
                    <textarea name="content" rows="8" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none bg-white" required>{{ old('content', $announcement['content']) }}</textarea>
                </div>

                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="urgent" value="1" {{ old('urgent', $announcement['urgent']) ? 'checked' : '' }} class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                        <span class="text-sm font-semibold text-gray-900">Mark as Urgent</span>
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Start Date (Optional)</label>
                        <input type="datetime-local" name="start_date" value="{{ old('start_date', $announcement['start_date']) }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">End Date (Optional)</label>
                        <input type="datetime-local" name="end_date" value="{{ old('end_date', $announcement['end_date']) }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white">
                    </div>
                </div>

                <div class="flex gap-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('staff.announcements') }}" class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 flex-1">
                        Update Announcement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

