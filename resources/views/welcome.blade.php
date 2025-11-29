<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kampay Ticket System - Professional Support Made Simple</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-[#faf9f6] min-h-screen">
    <nav class="bg-white shadow-soft sticky top-0 z-50 backdrop-blur-sm bg-white/95">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Kampay Logo" class="h-10 w-10 rounded-full object-cover ring-2 ring-[#007E6E]/20">
                    <span class="text-xl font-bold text-[#007E6E]">Kampay Tickets</span>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="text-[#2d3748] hover:text-[#007E6E] transition font-medium px-4 py-2 rounded-lg hover:bg-[#f5f3ed]">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary text-sm">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-20 animate-fade-in">
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#007E6E] to-[#73AF6F] rounded-full blur-2xl opacity-20 animate-pulse"></div>
                    <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Kampay Logo" class="h-32 w-32 rounded-full object-cover shadow-medium relative z-10 ring-4 ring-[#E7DEAF]/30">
                </div>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-[#2d3748] mb-6">
                Welcome to <span class="text-[#007E6E]">Kampay Tickets</span>
            </h1>
            <p class="text-xl text-[#4a5568] mb-10 max-w-2xl mx-auto leading-relaxed">
                A modern, professional ticket support system designed for simplicity and efficiency. 
                Create tickets, communicate seamlessly, and track your support requests with ease.
            </p>
            <div class="flex justify-center gap-4 flex-wrap">
                <a href="{{ route('register') }}" class="btn-primary text-base px-8 py-4">
                    Get Started Free
                </a>
                <a href="{{ route('login') }}" class="btn-secondary text-base px-8 py-4">
                    Sign In
                </a>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-20">
            <div class="card p-8 text-center animate-fade-in" style="animation-delay: 0.1s">
                <div class="w-16 h-16 bg-[#007E6E]/10 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-[#007E6E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-[#2d3748] mb-3">Create Tickets</h3>
                <p class="text-[#718096] leading-relaxed">
                    Submit support requests effortlessly. Add detailed descriptions, attach files, and set priorities to get help quickly.
                </p>
            </div>

            <div class="card p-8 text-center animate-fade-in" style="animation-delay: 0.2s">
                <div class="w-16 h-16 bg-[#E7DEAF]/30 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-[#D7C097]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-[#2d3748] mb-3">Real-time Communication</h3>
                <p class="text-[#718096] leading-relaxed">
                    Communicate seamlessly with support agents. Share files, images, and get instant responses in organized threads.
                </p>
            </div>

            <div class="card p-8 text-center animate-fade-in" style="animation-delay: 0.3s">
                <div class="w-16 h-16 bg-[#73AF6F]/10 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-[#73AF6F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-[#2d3748] mb-3">Track Progress</h3>
                <p class="text-[#718096] leading-relaxed">
                    Monitor your tickets from creation to resolution. Get real-time status updates and priority notifications.
                </p>
            </div>
        </div>

        <div class="mt-20 text-center">
            <div class="gradient-soft rounded-modern-lg p-12 animate-fade-in">
                <h2 class="text-3xl font-bold text-[#2d3748] mb-4">
                    Ready to Get Started?
                </h2>
                <p class="text-[#4a5568] mb-8 text-lg">
                    Join thousands of users who trust Kampay Tickets for their support needs.
                </p>
                <a href="{{ route('register') }}" class="btn-primary text-base px-10 py-4 inline-block">
                    Create Your Account
                </a>
            </div>
        </div>
    </main>

    <footer class="mt-20 py-8 border-t border-[#e2e8f0] bg-white/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-[#718096] text-sm">
                &copy; {{ date('Y') }} Kampay Tickets. Professional support made simple.
            </p>
        </div>
    </footer>
    </body>
</html>
