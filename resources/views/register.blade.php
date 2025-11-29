@extends('layouts.app')

@section('title', 'Register - Community Hub')

@section('content')
<div class="min-h-[calc(100vh-12rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full" data-aos="fade-up">
        <div class="modern-card p-8 lg:p-10">
            <div class="text-center mb-8">
                <div class="inline-block p-3 bg-primary-lighter rounded-2xl mb-4">
                    <img src="{{ asset('Logo/sklogo.png') }}" alt="Logo" class="h-16 w-16 rounded-full object-cover">
                </div>
                <h1 class="text-3xl font-bold text-text-primary mb-2">Join Community Hub</h1>
                <p class="text-text-secondary">Create your account to participate in community activities</p>
            </div>

            <form class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-text-primary mb-2">Full Name</label>
                    <input type="text" class="modern-input" placeholder="John Doe" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-text-primary mb-2">Email Address</label>
                    <input type="email" class="modern-input" placeholder="you@example.com" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-text-primary mb-2">Contact Number</label>
                    <input type="tel" class="modern-input" placeholder="0912-345-6789" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-text-primary mb-2">Address</label>
                    <input type="text" class="modern-input" placeholder="Block 5, Main Street" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-text-primary mb-2">Password</label>
                    <input type="password" class="modern-input" placeholder="••••••••" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-text-primary mb-2">Confirm Password</label>
                    <input type="password" class="modern-input" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-primary w-full py-3 rounded-lg font-semibold text-lg mt-6">
                    Create Account
                </button>

                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-sm text-text-secondary">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-semibold text-primary hover:text-primary-dark transition-colors">
                            Sign in
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

