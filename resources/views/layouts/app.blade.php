<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kampay Ticket System')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@400;700&family=Pacifico&family=Caveat:wght@400;700&family=Kaushan+Script&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-kampay-bg-warm dark:bg-kampay-bg-dark min-h-screen">
    <nav class="bg-white dark:bg-kampay-bg-darker shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Kampay Logo" class="h-10 w-10 rounded-full object-cover">
                        <span class="text-2xl kampay-brand">Kampay Tickets</span>
                    </a>
                </div>
                
                @if(auth()->check() && !request()->routeIs('register'))
                <div class="flex items-center space-x-4">
                    <a href="{{ route('tickets.index') }}" class="text-kampay-text-warm dark:text-white hover:text-kampay-teal transition">Tickets</a>
                    <a href="{{ route('tickets.create') }}" class="bg-kampay-teal hover:bg-kampay-teal-dark text-white px-4 py-2 rounded-lg transition transform hover:scale-105">New Ticket</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-kampay-text-warm dark:text-white hover:text-kampay-red transition">Logout</button>
                    </form>
                </div>
                @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-kampay-text-warm dark:text-white hover:text-kampay-teal transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-kampay-teal hover:bg-kampay-teal-dark text-white px-4 py-2 rounded-lg transition transform hover:scale-105">Sign Up</a>
                </div>
                @endif
            </div>
        </div>
    </nav>

    <main class="py-8">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
                <div class="bg-kampay-teal-light text-kampay-teal-dark px-4 py-3 rounded-lg border border-kampay-teal">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
                <div class="bg-kampay-red-light text-kampay-red-dark px-4 py-3 rounded-lg border border-kampay-red">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>

