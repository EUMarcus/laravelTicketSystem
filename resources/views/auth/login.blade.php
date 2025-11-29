@extends('layouts.app')

@section('title', 'Login - Kampay Tickets')

@section('content')
<div class="max-w-md mx-auto px-4">
    <div class="card card-elevated p-8 animate-fade-in">
        <div class="text-center mb-8">
            <div class="inline-block p-3 bg-[#007E6E]/10 rounded-2xl mb-4">
                <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Kampay Logo" class="h-16 w-16 rounded-full object-cover">
            </div>
            <h1 class="text-3xl font-bold text-[#2d3748] mb-2">Welcome Back!</h1>
            <p class="text-[#718096]">Sign in to continue to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-[#2d3748] mb-2">
                    Email Address
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    class="input-modern"
                    placeholder="you@example.com"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-[#2d3748] mb-2">
                    Password
                </label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required
                    class="input-modern"
                    placeholder="Enter your password"
                >
            </div>

            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember"
                    class="w-4 h-4 text-[#007E6E] border-gray-300 rounded focus:ring-[#007E6E]"
                >
                <label for="remember" class="ml-2 text-sm text-[#4a5568]">
                    Remember me
                </label>
            </div>

            <button 
                type="submit" 
                class="w-full btn-primary py-3 text-base"
            >
                Sign In
            </button>

            <div class="text-center pt-4 border-t border-[#e2e8f0]">
                <p class="text-sm text-[#718096]">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-[#007E6E] hover:text-[#005a4f] font-semibold transition">
                        Sign up
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection


