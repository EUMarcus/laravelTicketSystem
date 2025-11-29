@extends('layouts.app')

@section('title', 'Login - Community Hub')

@section('content')
<div class="min-h-[calc(100vh-12rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full" data-aos="fade-up">
        <div class="modern-card p-8 lg:p-10">
        <div class="text-center mb-8">
                <div class="inline-block p-3 bg-primary-lighter rounded-2xl mb-4">
                    <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Logo" class="h-16 w-16 rounded-full object-cover">
        </div>
                <h1 class="text-3xl font-bold text-text-primary mb-2">Welcome Back!</h1>
                <p class="text-text-secondary">Sign in to submit reports, vote, and engage with your community</p>
            </div>

            <form class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-text-primary mb-2">Email Address</label>
                    <input type="email" class="modern-input" placeholder="you@example.com" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-text-primary mb-2">Password</label>
                    <input type="password" class="modern-input" placeholder="••••••••" required>
            </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded">
                        <span class="ml-2 text-sm text-text-secondary">Remember me</span>
                </label>
            </div>

                <button type="submit" class="btn-primary w-full py-3 rounded-lg font-semibold text-lg">
                Sign In
            </button>

                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-sm text-text-secondary">
                    Don't have an account? 
                        <a href="{{ route('register') }}" class="font-semibold text-primary hover:text-primary-dark transition-colors">
                        Sign up
                    </a>
                </p>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
