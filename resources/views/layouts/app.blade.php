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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="bg-white min-h-screen font-sans" style="background-color: #ffffff !important; overflow-x: hidden !important; overflow-y: auto !important; max-width: 100vw !important; width: 100% !important;">
    <!-- Modern Navigation -->
    <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow-sm transition-transform duration-300" style="background-color: #ffffff !important; max-width: 100vw !important; width: 100% !important;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full object-cover border-2 border-[#65B741]/20 group-hover:border-[#65B741]/40">
                        </div>
                        <span class="text-xl font-bold text-[#65B741] group-hover:text-[#4d8a32]">Community Hub</span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">Home</a>
                    <a href="{{ route('reports.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('reports.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">Reports</a>
                    <a href="{{ route('suggestions.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('suggestions.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">Suggestions</a>
                    <a href="{{ route('announcements.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('announcements.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">Announcements</a>
                    <a href="{{ route('events.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('events.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">Events</a>
                    <a href="{{ route('polls.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('polls.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">Polls</a>
                    <a href="{{ route('faq.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('faq.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">FAQ</a>
                    @auth
                    <a href="{{ route('tickets.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('tickets.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">Tickets</a>
                    @endauth
                </div>

                <!-- Auth Buttons & Mobile Menu -->
                <div class="flex items-center space-x-3">
                    @auth
                    <a href="{{ route('tickets.index') }}" class="hidden md:block px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition-colors">Tickets</a>
                    <a href="{{ route('tickets.create') }}" class="hidden md:block px-5 py-2 text-sm font-semibold bg-[#65B741] text-white rounded-lg hover:bg-[#4d8a32] transition-colors">New Ticket</a>
                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition-colors">Logout</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="hidden md:block px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="hidden md:block px-5 py-2 text-sm font-semibold bg-[#65B741] text-white rounded-lg hover:bg-[#4d8a32] transition-colors">Register</a>
                    @endauth
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 bg-white">
            <div class="px-4 py-2 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">Home</a>
                <a href="{{ route('reports.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('reports.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">Reports</a>
                <a href="{{ route('suggestions.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('suggestions.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">Suggestions</a>
                <a href="{{ route('announcements.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('announcements.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">Announcements</a>
                <a href="{{ route('events.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('events.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">Events</a>
                <a href="{{ route('polls.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('polls.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">Polls</a>
                <a href="{{ route('faq.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('faq.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">FAQ</a>
                @auth
                <a href="{{ route('tickets.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('tickets.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">Tickets</a>
                <div class="border-t border-gray-200 mt-2 pt-2 space-y-1">
                    <a href="{{ route('tickets.create') }}" class="block px-4 py-2 text-sm font-semibold bg-[#65B741] text-white rounded-lg hover:bg-[#4d8a32]">New Ticket</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">Logout</button>
                    </form>
                </div>
                @else
                <div class="border-t border-gray-200 mt-2 pt-2 space-y-1">
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">Login</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-sm font-semibold bg-[#65B741] text-white rounded-lg hover:bg-[#4d8a32]">Register</a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="min-h-[calc(100vh-4rem)]" style="position: relative; background-color: transparent !important; overflow-y: visible !important; overflow-x: hidden !important;">
        <style>
            /* Add padding for fixed header, except for hero section */
            main {
                padding-top: 4rem !important;
            }
            /* Ensure hero section is visible above white background and starts at top */
            main > section:first-child {
                position: relative !important;
                z-index: 1 !important;
                background: transparent !important;
                background-color: transparent !important;
                margin-top: -4rem !important;
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
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Brand Section -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full object-cover border-2 border-[#65B741]/20">
                        <span class="text-xl font-bold text-[#65B741]">Community Hub</span>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Building stronger communities through engagement, transparency, and collaboration.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('reports.index') }}" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">Submit Report</a></li>
                        <li><a href="{{ route('suggestions.index') }}" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">Give Suggestion</a></li>
                        <li><a href="{{ route('events.index') }}" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">View Events</a></li>
                        <li><a href="{{ route('faq.index') }}" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">FAQs</a></li>
                    </ul>
                </div>
                
                <!-- Resources -->
                <div>
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Resources</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('announcements.index') }}" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">Announcements</a></li>
                        <li><a href="{{ route('polls.index') }}" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">Community Polls</a></li>
                        <li><a href="#" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">Contact Us</a></li>
                        <li><a href="#" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">About</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Contact</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Barangay Hall</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>(02) 123-4567</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>info@communityhub.ph</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Mon-Fri: 8:00 AM - 5:00 PM</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="border-t border-gray-200 pt-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-500 text-center md:text-left">
                        &copy; {{ date('Y') }} Barangay Community Hub. All rights reserved.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="text-sm text-gray-500 hover:text-[#65B741] transition-colors">Privacy Policy</a>
                        <span class="text-gray-300">|</span>
                        <a href="#" class="text-sm text-gray-500 hover:text-[#65B741] transition-colors">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Hide/show navbar on scroll
        let lastScrollTop = 0;
        const navbar = document.getElementById('main-nav');
        let isScrollingDown = false;

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Scrolling down - hide navbar
                if (!isScrollingDown) {
                    navbar.style.transform = 'translateY(-100%)';
                    isScrollingDown = true;
                }
            } else {
                // Scrolling up - show navbar
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
