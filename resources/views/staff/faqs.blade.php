@extends('layouts.app')

@section('title', 'FAQs - Staff Dashboard')

@section('content')
@if(session('user') && in_array(session('user')['role'] ?? '', ['employee', 'admin']))
<div class="flex min-h-screen" style="padding-top: 4rem;">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 fixed left-0 top-16 h-[calc(100vh-4rem)] overflow-y-auto z-40">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Staff Dashboard</h2>
            
            <nav class="space-y-2">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.dashboard') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Overview</span>
                </a>
                
                <div class="pt-4">
                    <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Manage</h3>
                    
                    <a href="{{ route('staff.reports') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.reports') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="font-medium">Reports</span>
                    </a>
                    
                    <a href="{{ route('staff.suggestions') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.suggestions') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <span class="font-medium">Suggestions</span>
                    </a>
                    
                    <a href="{{ route('staff.announcements') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.announcements') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                        <span class="font-medium">News & Events</span>
                    </a>
                    
                    <a href="{{ route('staff.faqs') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('staff.faqs*') ? 'bg-[#65B741]/10 text-[#65B741]' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">FAQs</span>
                    </a>
                    
                </div>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 min-h-screen" style="margin-top: -4rem !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-0 pb-8">
        <!-- Header -->
        <div class="mb-10">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">FAQs</h1>
                    <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
                    <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Manage frequently asked questions</p>
                </div>
                <a href="{{ route('staff.faqs.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Create FAQ</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6">
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($faqs->count() > 0)
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Answer</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($faqs as $faq)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $faq->order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $faq->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($faq->question, 50) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($faq->answer, 80) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('staff.faqs.edit', $faq->id) }}" class="text-[#65B741] hover:text-[#65B741]/80 mr-4">Edit</a>
                            <form action="{{ route('staff.faqs.destroy', $faq->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-12 text-center">
            <p class="text-gray-500 text-lg">No FAQs found. <a href="{{ route('staff.faqs.create') }}" class="text-[#65B741] hover:underline">Create your first FAQ</a></p>
        </div>
        @endif
    </div>
    </main>
</div>
@else
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
        <p>You do not have permission to access this page.</p>
    </div>
</div>
@endif
@endsection

