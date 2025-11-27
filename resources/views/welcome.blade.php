<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kampay Ticket System - Support That Brings the Party!</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@400;700&family=Pacifico&family=Caveat:wght@400;700&family=Kaushan+Script&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-kampay-bg-warm dark:bg-kampay-bg-dark min-h-screen">
    <nav class="bg-white dark:bg-kampay-bg-darker shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Kampay Logo" class="h-12 w-12 rounded-full object-cover">
                    <span class="text-3xl kampay-brand">Kampay Tickets</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-kampay-text-warm dark:text-white hover:text-kampay-teal transition font-medium">Log in</a>
                    <a href="{{ route('register') }}" class="bg-kampay-teal hover:bg-kampay-teal-dark text-white px-6 py-2 rounded-lg transition transform hover:scale-105 font-semibold">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-16">
            <div class="flex justify-center mb-8">
                <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Kampay Logo" class="h-32 w-32 rounded-full object-cover shadow-xl kampay-splash">
            </div>
            <h1 class="text-5xl md:text-6xl text-kampay-text-warm dark:text-white mb-6">
                Welcome to <span class="kampay-brand">Kampay Tickets</span>
            </h1>
            <p class="text-xl text-kampay-text-muted mb-8 max-w-2xl mx-auto">
                Your modern ticket support system that brings the party to customer service! 
                Create tickets, chat with support, and get the help you need.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-kampay-teal to-kampay-teal-dark hover:from-kampay-teal-dark hover:to-kampay-teal text-white font-semibold px-8 py-4 rounded-lg transition-all duration-200 transform hover:scale-105 text-lg">
                    Get Started
                </a>
                <a href="{{ route('login') }}" class="bg-white dark:bg-kampay-bg-darker border-2 border-kampay-teal text-kampay-teal hover:bg-kampay-teal-light dark:hover:bg-kampay-teal-dark font-semibold px-8 py-4 rounded-lg transition-all duration-200 transform hover:scale-105 text-lg">
                    Sign In
                </a>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mt-20">
            <div class="bg-white dark:bg-kampay-bg-darker rounded-xl shadow-lg p-8 kampay-splash">
                <div class="w-16 h-16 bg-kampay-teal-light rounded-full flex items-center justify-center mb-4 mx-auto">
                    <svg class="w-8 h-8 text-kampay-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-kampay-text-warm dark:text-white mb-3 text-center">Create Tickets</h3>
                <p class="text-kampay-text-muted text-center">
                    Submit support requests with ease. Add descriptions, files, and set priorities to get help fast.
                </p>
            </div>

            <div class="bg-white dark:bg-kampay-bg-darker rounded-xl shadow-lg p-8 kampay-splash">
                <div class="w-16 h-16 bg-kampay-yellow-orange bg-opacity-20 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <svg class="w-8 h-8 text-kampay-yellow-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-kampay-text-warm dark:text-white mb-3 text-center">Live Chat</h3>
                <p class="text-kampay-text-muted text-center">
                    Communicate in real-time with support agents. Share files, images, and get instant responses.
                </p>
            </div>

            <div class="bg-white dark:bg-kampay-bg-darker rounded-xl shadow-lg p-8 kampay-splash">
                <div class="w-16 h-16 bg-kampay-blue bg-opacity-20 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <svg class="w-8 h-8 text-kampay-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-kampay-text-warm dark:text-white mb-3 text-center">Track Progress</h3>
                <p class="text-kampay-text-muted text-center">
                    Monitor your tickets from creation to resolution. See status updates and priority levels.
                </p>
            </div>
        </div>

        <div class="mt-20 text-center">
            <div class="bg-gradient-to-r from-kampay-teal-light to-kampay-blue-light rounded-2xl p-12 kampay-splash">
                <h2 class="text-3xl font-bold text-kampay-text-warm dark:text-white mb-4">
                    Ready to Get Started?
                </h2>
                <p class="text-kampay-text-muted mb-8 text-lg">
                    Join Kampay Tickets and experience customer support that brings the party!
                </p>
                <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-kampay-teal to-kampay-teal-dark hover:from-kampay-teal-dark hover:to-kampay-teal text-white font-semibold px-10 py-4 rounded-lg transition-all duration-200 transform hover:scale-105 text-lg">
                    Create Your Account
                </a>
            </div>
        </div>
    </main>

    <footer class="mt-20 py-8 border-t border-gray-200 dark:border-kampay-bg-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-kampay-text-muted">
                &copy; {{ date('Y') }} Kampay Tickets. Bringing the party to support! 🎉
            </p>
        </div>
    </footer>
    </body>
</html>
