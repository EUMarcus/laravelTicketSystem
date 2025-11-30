@extends('layouts.app')

@section('title', 'About Us - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 4rem;">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">About Community Hub</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Building stronger communities through engagement, transparency, and collaboration.
        </p>
    </div>

    <!-- Mission Section -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-8 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-16 h-16 bg-[#65B741]/10 rounded-lg flex items-center justify-center">
                <svg class="w-8 h-8 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Our Mission</h2>
        </div>
        <p class="text-lg text-gray-700 leading-relaxed">
            Community Hub is dedicated to fostering a more connected, engaged, and responsive barangay community. 
            We believe that effective communication and active citizen participation are the cornerstones of a thriving 
            community. Our platform provides residents with easy access to report issues, share suggestions, and stay 
            informed about important announcements and events.
        </p>
    </div>

    <!-- What We Do Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">What We Do</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                <div class="w-12 h-12 bg-[#65B741]/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Report Management</h3>
                <p class="text-gray-600">
                    Submit and track community reports and issues. Our staff team reviews and addresses each report 
                    to ensure timely resolution.
                </p>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Community Suggestions</h3>
                <p class="text-gray-600">
                    Share your ideas and suggestions to improve our community. Engage with other residents through 
                    comments and discussions.
                </p>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                <div class="w-12 h-12 bg-yellow-50 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Announcements</h3>
                <p class="text-gray-600">
                    Stay informed about important community events, meetings, health advisories, and other 
                    announcements from the barangay.
                </p>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="bg-gray-50 rounded-lg p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Values</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-[#65B741] rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Community First</h3>
                    <p class="text-gray-600">
                        Every decision we make prioritizes the well-being and interests of our community members.
                    </p>
                </div>
            </div>

            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-[#65B741] rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Transparency</h3>
                    <p class="text-gray-600">
                        We believe in open communication and keeping our community informed about all matters.
                    </p>
                </div>
            </div>

            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-[#65B741] rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Collaboration</h3>
                    <p class="text-gray-600">
                        We work together with residents, staff, and community leaders to achieve common goals.
                    </p>
                </div>
            </div>

            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-[#65B741] rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Responsiveness</h3>
                    <p class="text-gray-600">
                        We are committed to addressing community concerns and feedback in a timely manner.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-[#65B741] rounded-lg p-8 text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Join Us in Building a Better Community</h2>
        <p class="text-lg mb-6 opacity-90">
            Your participation makes a difference. Get involved today!
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('reports.create') }}" class="px-6 py-3 bg-white text-[#65B741] font-semibold rounded-lg hover:bg-gray-100 transition-colors">
                Submit a Report
            </a>
            <a href="{{ route('suggestions.create') }}" class="px-6 py-3 bg-white text-[#65B741] font-semibold rounded-lg hover:bg-gray-100 transition-colors">
                Share a Suggestion
            </a>
            <a href="{{ route('contact') }}" class="px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-[#65B741] transition-colors">
                Contact Us
            </a>
        </div>
    </div>
</div>
@endsection

