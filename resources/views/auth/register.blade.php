@extends('layouts.app')

@section('title', 'Register - Community Hub')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-center min-h-[calc(100vh-20rem)]">
        <div class="w-full max-w-md" data-aos="fade-up">
            <div class="modern-card p-8 lg:p-10">
            <div class="text-center mb-8">
                <div class="inline-block p-3 bg-primary-lighter rounded-2xl mb-4">
                    <img src="{{ asset('Logo/kampay_logo.jpg') }}" alt="Logo" class="h-16 w-16 rounded-full object-cover">
                </div>
                <h1 class="text-3xl font-bold text-text-primary mb-2">Join Community Hub</h1>
                <p class="text-text-secondary">Create your account to participate in community activities</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="bg-error-light border border-error text-error px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label for="name" class="block text-sm font-semibold text-text-primary mb-2">
                        Full Name <span class="text-error">*</span>
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        class="modern-input @error('name') border-error @enderror" 
                        placeholder="John Doe" 
                        required 
                        autofocus
                        autocomplete="name"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-text-primary mb-2">
                        Email Address <span class="text-error">*</span>
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        class="modern-input @error('email') border-error @enderror" 
                        placeholder="you@example.com" 
                        required
                        autocomplete="email"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact" class="block text-sm font-semibold text-text-primary mb-2">
                        Contact Number <span class="text-text-muted font-normal">(Optional)</span>
                    </label>
                    <input 
                        id="contact" 
                        type="tel" 
                        name="contact" 
                        value="{{ old('contact') }}" 
                        class="modern-input @error('contact') border-error @enderror" 
                        placeholder="0912-345-6789"
                        autocomplete="tel"
                    >
                    @error('contact')
                        <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-semibold text-text-primary mb-2">
                        Address <span class="text-text-muted font-normal">(Optional)</span>
                    </label>
                    <input 
                        id="address" 
                        type="text" 
                        name="address" 
                        value="{{ old('address') }}" 
                        class="modern-input @error('address') border-error @enderror" 
                        placeholder="Block 5, Main Street"
                        autocomplete="street-address"
                    >
                    @error('address')
                        <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-text-primary mb-2">
                        Password <span class="text-error">*</span>
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        class="modern-input @error('password') border-error @enderror" 
                        placeholder="••••••••" 
                        required
                        autocomplete="new-password"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-text-muted">Must be at least 8 characters</p>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-text-primary mb-2">
                        Confirm Password <span class="text-error">*</span>
                    </label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        class="modern-input @error('password_confirmation') border-error @enderror" 
                        placeholder="••••••••" 
                        required
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
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

