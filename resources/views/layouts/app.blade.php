<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kampay Ticket System')</title>
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
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-[#007E6E] to-[#73AF6F] flex items-center justify-center ring-2 ring-[#007E6E]/20 group-hover:ring-[#007E6E]/40 transition-all">
                                <span class="text-white font-bold text-lg">BH</span>
                            </div>
                        </div>
                        <span class="text-xl font-bold text-[#007E6E] kampay-brand">Barangay Community Hub</span>
                    </a>
                </div>
                
                @auth
                <div class="flex items-center space-x-2 overflow-x-auto">
                    <a href="{{ route('dashboard') }}" class="text-[#2d3748] hover:text-[#007E6E] transition font-medium px-3 py-2 rounded-lg hover:bg-[#f5f3ed] whitespace-nowrap">
                        Dashboard
                    </a>
                    <a href="{{ route('reports.index') }}" class="text-[#2d3748] hover:text-[#007E6E] transition font-medium px-3 py-2 rounded-lg hover:bg-[#f5f3ed] whitespace-nowrap">
                        Reports
                    </a>
                    <a href="{{ route('suggestions.index') }}" class="text-[#2d3748] hover:text-[#007E6E] transition font-medium px-3 py-2 rounded-lg hover:bg-[#f5f3ed] whitespace-nowrap">
                        Suggestions
                    </a>
                    <a href="{{ route('announcements.index') }}" class="text-[#2d3748] hover:text-[#007E6E] transition font-medium px-3 py-2 rounded-lg hover:bg-[#f5f3ed] whitespace-nowrap">
                        Announcements
                    </a>
                    <a href="{{ route('events.index') }}" class="text-[#2d3748] hover:text-[#007E6E] transition font-medium px-3 py-2 rounded-lg hover:bg-[#f5f3ed] whitespace-nowrap">
                        Events
                    </a>
                    <a href="{{ route('polls.index') }}" class="text-[#2d3748] hover:text-[#007E6E] transition font-medium px-3 py-2 rounded-lg hover:bg-[#f5f3ed] whitespace-nowrap">
                        Polls
                    </a>
                    <a href="{{ route('faqs.index') }}" class="text-[#2d3748] hover:text-[#007E6E] transition font-medium px-3 py-2 rounded-lg hover:bg-[#f5f3ed] whitespace-nowrap">
                        FAQ
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-[#718096] hover:text-[#dc2626] transition font-medium px-3 py-2 rounded-lg hover:bg-[#f5f3ed] whitespace-nowrap">
                            Logout
                        </button>
                    </form>
                </div>
                @else
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="text-[#2d3748] hover:text-[#007E6E] transition font-medium px-4 py-2 rounded-lg hover:bg-[#f5f3ed]">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary text-sm">
                        Sign Up
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="py-6 min-h-[calc(100vh-4rem)]">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4 animate-fade-in">
                <div class="bg-[#73AF6F]/10 border border-[#73AF6F]/30 text-[#73AF6F] px-4 py-3 rounded-modern flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4 animate-fade-in">
                <div class="bg-[#dc2626]/10 border border-[#dc2626]/30 text-[#dc2626] px-4 py-3 rounded-modern">
                    <div class="flex items-start space-x-2">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <ul class="space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="mt-12 py-6 border-t border-[#e2e8f0] bg-white/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-[#718096] text-sm">
                &copy; {{ date('Y') }} Kampay Tickets. Professional support made simple.
            </p>
        </div>
    </footer>
</body>
</html>

