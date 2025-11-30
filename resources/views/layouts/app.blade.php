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
                            <img src="{{ asset('Logo/sklogo.png') }}" alt="Logo" class="h-10 w-10 rounded-full object-cover border-2 border-[#65B741]/20 group-hover:border-[#65B741]/40">
                        </div>
                        <span class="text-xl font-bold text-[#65B741] group-hover:text-[#4d8a32]">Community Hub</span>
                    </a>
                </div>
                
                <!-- Desktop Navigation - Hidden only on staff dashboard pages -->
                @if(!request()->routeIs('staff.*'))
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">Home</a>
                    <a href="{{ route('reports.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('reports.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">Reports</a>
                    <a href="{{ route('suggestions.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('suggestions.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">Suggestions</a>
                    <a href="{{ route('announcements.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('announcements.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">News & Events</a>
                    <a href="{{ route('faq.index') }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs('faq.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg transition-colors">FAQ</a>
                </div>
                @endif

                <!-- Auth Buttons & Mobile Menu -->
                <div class="flex items-center space-x-3">
                    @auth
                        <!-- User Menu (Separate Buttons) -->
                        <div class="hidden md:flex items-center space-x-3">
                            <a href="{{ route('profile.index') }}" class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-600 hover:text-[#65B741] rounded-lg">
                                <div class="w-8 h-8 bg-[#65B741] rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            @if(session('user')['role'] === 'employee')
                            <a href="{{ route('staff.dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-[#65B741] rounded-lg">
                                Dashboard
                            </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" id="logoutFormDesktop" onsubmit="handleLogout(event)">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden md:flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span>Login</span>
                        </a>
                        <a href="{{ route('register') }}" class="hidden md:flex items-center space-x-2 px-5 py-2 text-sm font-semibold bg-[#65B741] text-white rounded-lg hover:bg-[#4d8a32] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span>Register</span>
                        </a>
                    @endauth
                    <!-- Mobile menu button - Hidden only on staff dashboard pages -->
                    @if(!request()->routeIs('staff.*'))
                    <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu - Hidden only on staff dashboard pages -->
        @if(!request()->routeIs('staff.*'))
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 bg-white">
            <div class="px-4 py-2 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">Home</a>
                <a href="{{ route('reports.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('reports.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">Reports</a>
                <a href="{{ route('suggestions.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('suggestions.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">Suggestions</a>
                <a href="{{ route('announcements.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('announcements.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">News & Events</a>
                <a href="{{ route('faq.index') }}" class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('faq.*') ? 'text-[#65B741] bg-[#65B741]/10' : 'text-gray-600' }} hover:text-[#65B741] hover:bg-[#65B741]/10 rounded-lg">FAQ</a>
                @auth
                <div class="border-t border-gray-200 mt-2 pt-2 space-y-1">
                    <!-- User Menu (Mobile - Separate Buttons) -->
                    <div class="block md:hidden space-y-1">
                        <a href="{{ route('profile.index') }}" class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-600 hover:text-[#65B741] rounded-lg">
                            <div class="w-8 h-8 bg-[#65B741] rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">{{ strtoupper(substr(session('user')['name'] ?? Auth::user()->name, 0, 1)) }}</span>
                            </div>
                            <span>{{ session('user')['name'] ?? Auth::user()->name }}</span>
                        </a>
                        @if((session('user')['role'] ?? Auth::user()->profile->role ?? 'citizen') === 'employee')
                        <a href="{{ route('staff.dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-[#65B741] rounded-lg">
                            Dashboard
                        </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" id="logoutFormMobile" onsubmit="handleLogout(event)">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="border-t border-gray-200 mt-2 pt-2 space-y-1">
                    <a href="{{ route('login') }}" class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center space-x-2 px-4 py-2 text-sm font-semibold bg-[#65B741] text-white rounded-lg hover:bg-[#4d8a32]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span>Register</span>
                    </a>
                </div>
                @endauth
            </div>
        </div>
        @endif
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
        <!-- Success Modal -->
        @if(session('success'))
            <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(2px);">
                <div class="bg-white rounded-lg shadow-xl w-full mx-4 transform transition-all" style="max-width: 320px;">
                    <div class="p-6">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-16 h-16 bg-[#65B741]/10 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-[#65B741]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Success!</h3>
                        <p class="text-gray-600 text-center mb-6">{{ session('success') }}</p>
                        <button onclick="closeSuccessModal()" class="w-full px-6 py-3 bg-[#65B741] text-white font-semibold rounded-lg hover:bg-[#4d8a32] transition-colors">
                            Okay
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    @if(!request()->routeIs('staff.*'))
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Brand Section -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('Logo/sklogo.png') }}" alt="Logo" class="h-10 w-10 rounded-full object-cover border-2 border-[#65B741]/20">
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
                        <li><a href="{{ route('faq.index') }}" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">FAQs</a></li>
                    </ul>
                </div>
                
                <!-- Resources -->
                <div>
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Resources</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('announcements.index') }}" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">Announcements</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">Contact Us</a></li>
                        <li><a href="{{ route('about') }}" class="text-sm text-gray-600 hover:text-[#65B741] transition-colors">About</a></li>
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
                        <a href="{{ route('privacy-policy') }}" class="text-sm text-gray-500 hover:text-[#65B741] transition-colors">Privacy Policy</a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('terms-of-service') }}" class="text-sm text-gray-500 hover:text-[#65B741] transition-colors">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @endif

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }


        // Keep navbar fixed at top (removed hide/show on scroll behavior)
        const navbar = document.getElementById('main-nav');
        navbar.style.transform = 'translateY(0)';
        navbar.style.position = 'fixed';
        navbar.style.top = '0';
        navbar.style.left = '0';
        navbar.style.right = '0';
        navbar.style.zIndex = '50';

        // Handle logout - clear all localStorage data
        window.handleLogout = function(e) {
            e.preventDefault();
            
            // Clear all authentication and user-related localStorage data
            localStorage.removeItem('user_reports');
            localStorage.removeItem('report_chat_messages');
            localStorage.removeItem('suggestion_user_id');
            localStorage.removeItem('suggestion_user_name');
            localStorage.removeItem('suggestion_votes');
            localStorage.removeItem('suggestion_comments');
            localStorage.removeItem('user_suggestion_votes');
            localStorage.removeItem('user_suggestions');
            
            // Clear dynamic keys (suggestion_comments_*, user_suggestion_*, suggestion_votes_*)
            for (let i = localStorage.length - 1; i >= 0; i--) {
                const key = localStorage.key(i);
                if (key && (key.startsWith('suggestion_comments_') || key.startsWith('user_suggestion_') || key.startsWith('suggestion_votes_'))) {
                    localStorage.removeItem(key);
                }
            }
            
            // Submit the form to logout from session
            e.target.closest('form').submit();
        };

        // Clear localStorage on logout (if redirected from logout)
        @if(session('logout'))
            // Clear all authentication and user-related localStorage data
            localStorage.removeItem('user_reports');
            localStorage.removeItem('report_chat_messages');
            localStorage.removeItem('suggestion_user_id');
            localStorage.removeItem('suggestion_user_name');
            localStorage.removeItem('suggestion_votes');
            localStorage.removeItem('suggestion_comments');
            localStorage.removeItem('user_suggestion_votes');
            localStorage.removeItem('user_suggestions');
            
            // Clear dynamic keys (suggestion_comments_*, user_suggestion_*, suggestion_votes_*)
            for (let i = localStorage.length - 1; i >= 0; i--) {
                const key = localStorage.key(i);
                if (key && (key.startsWith('suggestion_comments_') || key.startsWith('user_suggestion_') || key.startsWith('suggestion_votes_'))) {
                    localStorage.removeItem(key);
                }
            }
        @endif

        // Success Modal Functions
        function closeSuccessModal() {
            const modal = document.getElementById('successModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // Close modal when clicking outside
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('successModal');
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            closeSuccessModal();
                        }
                    });
                }
            });
        @endif
    </script>
</body>
</html>
