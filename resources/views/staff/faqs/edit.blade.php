@extends('layouts.app')

@section('title', 'Edit FAQ - Staff Dashboard')

@section('content')
@if(session('user') && in_array(session('user')['role'] ?? '', ['employee', 'admin']))
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Edit FAQ</h1>
        <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full"></div>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('staff.faqs.update', $faq->id) }}" method="POST" class="bg-white rounded-lg border border-gray-200 shadow-sm p-8">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
            <input type="text" name="category" id="category" value="{{ old('category', $faq->category) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none"
                placeholder="e.g., Reporting & Tickets">
        </div>

        <div class="mb-6">
            <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Question</label>
            <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none"
                placeholder="Enter the question">
        </div>

        <div class="mb-6">
            <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">Answer</label>
            <textarea name="answer" id="answer" rows="6" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none"
                placeholder="Enter the answer">{{ old('answer', $faq->answer) }}</textarea>
        </div>

        <div class="mb-6">
            <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order (optional)</label>
            <input type="number" name="order" id="order" value="{{ old('order', $faq->order) }}" min="0"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none"
                placeholder="0">
            <p class="mt-1 text-sm text-gray-500">Lower numbers appear first. Default is 0.</p>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                Update FAQ
            </button>
            <a href="{{ route('staff.faqs') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200">
                Cancel
            </a>
        </div>
    </form>
</div>
@else
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
        <p>You do not have permission to access this page.</p>
    </div>
</div>
@endif
@endsection

