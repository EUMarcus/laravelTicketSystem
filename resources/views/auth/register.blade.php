@extends('layouts.app')

@section('title', 'Register - Kampay Tickets')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-kampay-bg-darker rounded-2xl shadow-xl p-8 kampay-splash">
        <div class="text-center mb-8">
            <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Kampay Logo" class="h-20 w-20 mx-auto mb-4 rounded-full object-cover">
            <h1 class="text-3xl font-bold text-kampay-text-warm dark:text-white">Join Kampay!</h1>
            <p class="text-kampay-text-muted mt-2">Create your account to get started</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-kampay-text-warm dark:text-white mb-2">
                    Full Name
                </label>
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-kampay-bg-dark focus:ring-2 focus:ring-kampay-teal focus:border-transparent dark:bg-kampay-bg-dark dark:text-white"
                    placeholder="John Doe"
                >
            </div>

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
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-kampay-bg-dark focus:ring-2 focus:ring-kampay-teal focus:border-transparent dark:bg-kampay-bg-dark dark:text-white"
                    placeholder="you@example.com"
                >
            </div>

            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-kampay-text-warm dark:text-white mb-2">
                    I am a...
                </label>
                <select 
                    id="role" 
                    name="role" 
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-kampay-bg-dark focus:ring-2 focus:ring-kampay-teal focus:border-transparent dark:bg-kampay-bg-dark dark:text-white"
                >
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                </select>
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

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-kampay-text-warm dark:text-white mb-2">
                    Confirm Password
                </label>
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-kampay-bg-dark focus:ring-2 focus:ring-kampay-teal focus:border-transparent dark:bg-kampay-bg-dark dark:text-white"
                    placeholder="••••••••"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-kampay-teal to-kampay-teal-dark hover:from-kampay-teal-dark hover:to-kampay-teal text-white font-semibold py-3 rounded-lg transition-all duration-200 transform hover:scale-[1.02]"
            >
                Create Account
            </button>

            <div class="mt-6 text-center">
                <p class="text-sm text-kampay-text-muted">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-kampay-teal hover:text-kampay-teal-dark font-medium">
                        Sign in
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection


