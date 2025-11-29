@extends('layouts.app')

@section('title', 'Register - Kampay Tickets')

@section('content')
<div class="max-w-md mx-auto px-4">
    <div class="card card-elevated p-8 animate-fade-in">
        <div class="text-center mb-8">
            <div class="inline-block p-3 bg-[#007E6E]/10 rounded-2xl mb-4">
                <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Kampay Logo" class="h-16 w-16 rounded-full object-cover">
            </div>
            <h1 class="text-3xl font-bold text-[#2d3748] mb-2">Create Account</h1>
            <p class="text-[#718096]">Join Kampay Tickets and get started</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-[#2d3748] mb-2">
                    Full Name
                </label>
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus
                    class="input-modern"
                    placeholder="John Doe"
                >
            </div>

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
                    class="input-modern"
                    placeholder="you@example.com"
                >
            </div>

            <div>
                <label for="role" class="block text-sm font-semibold text-[#2d3748] mb-2">
                    I am a...
                </label>
                <select 
                    id="role" 
                    name="role" 
                    required
                    class="input-modern"
                >
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                </select>
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
                    placeholder="Create a strong password"
                >
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-[#2d3748] mb-2">
                    Confirm Password
                </label>
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    required
                    class="input-modern"
                    placeholder="Confirm your password"
                >
            </div>

            <button 
                type="submit" 
                class="w-full btn-primary py-3 text-base"
            >
                Create Account
            </button>

            <div class="text-center pt-4 border-t border-[#e2e8f0]">
                <p class="text-sm text-[#718096]">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-[#007E6E] hover:text-[#005a4f] font-semibold transition">
                        Sign in
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection


