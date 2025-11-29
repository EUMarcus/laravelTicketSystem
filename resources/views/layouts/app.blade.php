<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Barangay Community Hub')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen font-sans" style="background-color: #ffffff !important;">
    <!-- Modern Navigation -->
    <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 border-b-2 border-gray-300 transition-transform duration-300" style="background-color: #ffffff !important; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full object-cover ring-2 ring-primary-lighter group-hover:ring-primary transition-all duration-300">
                            <div class="absolute -inset-1 bg-gradient-to-r from-primary to-secondary rounded-full opacity-0 group-hover:opacity-20 blur transition-opacity duration-300"></div>
                        </div>
                        <span class="text-xl font-bold kampay-brand">Community Hub</span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-primary' : 'text-text-secondary' }} hover:text-primary rounded-lg hover:bg-primary-lighter transition-all duration-200">Home</a>
                    <a href="{{ route('reports.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('reports.*') ? 'text-primary' : 'text-text-secondary' }} hover:text-primary rounded-lg hover:bg-primary-lighter transition-all duration-200">Reports</a>
                    <a href="{{ route('suggestions.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('suggestions.*') ? 'text-primary' : 'text-text-secondary' }} hover:text-primary rounded-lg hover:bg-primary-lighter transition-all duration-200">Suggestions</a>
                    <a href="{{ route('announcements.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('announcements.*') ? 'text-primary' : 'text-text-secondary' }} hover:text-primary rounded-lg hover:bg-primary-lighter transition-all duration-200">Announcements</a>
                    <a href="{{ route('events.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('events.*') ? 'text-primary' : 'text-text-secondary' }} hover:text-primary rounded-lg hover:bg-primary-lighter transition-all duration-200">Events</a>
                    <a href="{{ route('polls.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('polls.*') ? 'text-primary' : 'text-text-secondary' }} hover:text-primary rounded-lg hover:bg-primary-lighter transition-all duration-200">Polls</a>
                    <a href="{{ route('faq.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('faq.*') ? 'text-primary' : 'text-text-secondary' }} hover:text-primary rounded-lg hover:bg-primary-lighter transition-all duration-200">FAQ</a>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-text-secondary hover:text-primary rounded-lg hover:bg-primary-lighter transition-all duration-200">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary px-5 py-2 text-sm font-semibold rounded-lg">Register</a>
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200" style="background-color: #ffffff !important;">
            <div class="px-4 py-2 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm font-medium text-text-secondary hover:text-primary rounded-lg hover:bg-primary-lighter">Home</a>
                <a href="{{ route('reports.index') }}" class="block px-4 py-2 text-sm font-medium text-text-secondary hover:text-primary rounded-lg hover:bg-primary-lighter">Reports</a>
                <a href="{{ route('suggestions.index') }}" class="block px-4 py-2 text-sm font-medium text-text-secondary hover:text-primary rounded-lg hover:bg-primary-lighter">Suggestions</a>
                <a href="{{ route('announcements.index') }}" class="block px-4 py-2 text-sm font-medium text-text-secondary hover:text-primary rounded-lg hover:bg-primary-lighter">Announcements</a>
                <a href="{{ route('events.index') }}" class="block px-4 py-2 text-sm font-medium text-text-secondary hover:text-primary rounded-lg hover:bg-primary-lighter">Events</a>
                <a href="{{ route('polls.index') }}" class="block px-4 py-2 text-sm font-medium text-text-secondary hover:text-primary rounded-lg hover:bg-primary-lighter">Polls</a>
                <a href="{{ route('faq.index') }}" class="block px-4 py-2 text-sm font-medium text-text-secondary hover:text-primary rounded-lg hover:bg-primary-lighter">FAQ</a>
                <div class="border-t border-gray-200 mt-2 pt-2">
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-sm font-medium text-text-secondary hover:text-primary rounded-lg hover:bg-primary-lighter">Login</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-sm font-medium text-primary bg-primary-lighter rounded-lg">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-[calc(100vh-4rem)]" style="position: relative; background-color: transparent !important; margin-top: 0 !important;">
        <style>
            /* Ensure hero section is visible above white background */
            main > section:first-child {
                position: relative !important;
                z-index: 1 !important;
                background: transparent !important;
                background-color: transparent !important;
                margin-top: 0 !important;
                padding-top: 0 !important;
            }
            main > section:first-child img.hero-parallax {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                z-index: 0 !important;
            }
            main > section:first-child h1,
            main > section:first-child h1 *,
            main > section:first-child p {
                color: white !important;
                text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8) !important;
                z-index: 10 !important;
                position: relative !important;
            }
            /* Rest of content has white background */
            main > div.max-w-7xl {
                background-color: #ffffff !important;
            }
        </style>
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6" style="position: relative; z-index: 50;">
                <div class="alert alert-success animate-slide-in" data-aos="fade-down">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid md:grid-cols-4 gap-8 mb-6">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full object-cover">
                        <span class="font-bold text-lg kampay-brand">Community Hub</span>
                    </div>
                    <p class="text-sm text-text-secondary">
                        Building stronger communities through engagement, transparency, and collaboration.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-text-primary mb-3">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('reports.index') }}" class="text-text-secondary hover:text-primary transition-colors">Submit Report</a></li>
                        <li><a href="{{ route('suggestions.index') }}" class="text-text-secondary hover:text-primary transition-colors">Give Suggestion</a></li>
                        <li><a href="{{ route('events.index') }}" class="text-text-secondary hover:text-primary transition-colors">View Events</a></li>
                        <li><a href="{{ route('faq.index') }}" class="text-text-secondary hover:text-primary transition-colors">FAQs</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-text-primary mb-3">Resources</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('announcements.index') }}" class="text-text-secondary hover:text-primary transition-colors">Announcements</a></li>
                        <li><a href="{{ route('polls.index') }}" class="text-text-secondary hover:text-primary transition-colors">Community Polls</a></li>
                        <li><a href="#" class="text-text-secondary hover:text-primary transition-colors">Contact Us</a></li>
                        <li><a href="#" class="text-text-secondary hover:text-primary transition-colors">About</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-text-primary mb-3">Contact</h3>
                    <ul class="space-y-2 text-sm text-text-secondary">
                        <li>📍 Barangay Hall</li>
                        <li>📞 (02) 123-4567</li>
                        <li>✉️ info@communityhub.ph</li>
                        <li>🕐 Mon-Fri: 8:00 AM - 5:00 PM</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-200 pt-6 text-center">
                <p class="text-sm text-text-muted">
                    &copy; {{ date('Y') }} Barangay Community Hub. Building stronger communities together.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Hide/show navbar on scroll
        let lastScrollTop = 0;
        const navbar = document.getElementById('main-nav');
        let isScrollingDown = false;

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Scrolling down
                if (!isScrollingDown) {
                    navbar.style.transform = 'translateY(-100%)';
                    isScrollingDown = true;
                }
            } else {
                // Scrolling up
                if (isScrollingDown) {
                    navbar.style.transform = 'translateY(0)';
                    isScrollingDown = false;
                }
            }
            
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    </script>
</body>
</html>
