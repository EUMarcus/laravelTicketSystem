@extends('layouts.app')

@section('title', 'Contact Us - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 4rem;">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Contact Us</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            We're here to help! Reach out to us with any questions, concerns, or feedback.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 mb-12">
        <!-- Contact Information -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Get in Touch</h2>
            
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-[#65B741]/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Address</h3>
                        <p class="text-gray-600">Barangay Hall</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-[#65B741]/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                        <p class="text-gray-600">(02) 123-4567</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-[#65B741]/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                        <p class="text-gray-600">info@communityhub.ph</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-[#65B741]/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Office Hours</h3>
                        <p class="text-gray-600">Mon-Fri: 8:00 AM - 5:00 PM</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h2>
            
            <form class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-transparent" placeholder="Your name">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-transparent" placeholder="your.email@example.com">
                </div>

                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                    <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-transparent" placeholder="What is this regarding?">
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#65B741] focus:border-transparent" placeholder="Your message..."></textarea>
                </div>

                <button type="submit" class="w-full px-6 py-3 bg-[#65B741] text-white font-semibold rounded-lg hover:bg-[#4d8a32] transition-colors">
                    Send Message
                </button>
            </form>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="bg-gray-50 rounded-lg p-8 text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Other Ways to Reach Us</h2>
        <p class="text-gray-600 mb-6">
            You can also submit reports, suggestions, or view announcements through our platform.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('reports.create') }}" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                Submit a Report
            </a>
            <a href="{{ route('suggestions.create') }}" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                Give a Suggestion
            </a>
            <a href="{{ route('announcements.index') }}" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                View Announcements
            </a>
        </div>
    </div>
</div>
@endsection

