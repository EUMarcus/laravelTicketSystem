@extends('layouts.app')

@section('title', 'Login - Kampay Tickets')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-kampay-bg-darker rounded-2xl shadow-xl p-8 kampay-splash">
        <div class="text-center mb-8">
            <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Kampay Logo" class="h-20 w-20 mx-auto mb-4 rounded-full object-cover">
            <h1 class="text-3xl font-bold text-kampay-text-warm dark:text-white">Welcome Back!</h1>
            <p class="text-kampay-text-muted mt-2">Sign in to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-kampay-text-warm dark:text-white mb-2">
                    Email Address
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-kampay-bg-dark focus:ring-2 focus:ring-kampay-teal focus:border-transparent dark:bg-kampay-bg-dark dark:text-white"
                    placeholder="you@example.com"
                >
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-kampay-text-warm dark:text-white mb-2">
                    Password
                </label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-kampay-bg-dark focus:ring-2 focus:ring-kampay-teal focus:border-transparent dark:bg-kampay-bg-dark dark:text-white"
                    placeholder="••••••••"
                >
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        class="rounded border-gray-300 text-kampay-teal focus:ring-kampay-teal"
                    >
                    <span class="ml-2 text-sm text-kampay-text-warm dark:text-white">Remember me</span>
                </label>
            </div>

            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-kampay-teal to-kampay-teal-dark hover:from-kampay-teal-dark hover:to-kampay-teal text-white font-semibold py-3 rounded-lg transition-all duration-200 transform hover:scale-[1.02]"
            >
                Sign In
            </button>

            <div class="mt-6 text-center">
                <p class="text-sm text-kampay-text-muted">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-kampay-teal hover:text-kampay-teal-dark font-medium">
                        Sign up
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection


