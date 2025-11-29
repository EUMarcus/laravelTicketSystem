@extends('layouts.app')

@section('title', 'Login - Community Hub')

@section('content')
<div class="min-h-[calc(100vh-5rem)] flex items-center justify-center px-4 sm:px-6 lg:px-8" style="padding-top: 5rem !important;">
    <div class="w-full" style="max-width: 450px;">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Welcome Back</h1>
            <div class="w-32 h-1.5 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-3 mx-auto"></div>
            <p class="text-base text-gray-600">Sign in to submit reports, vote, and engage with your community</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                @if($errors->has('email'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="you@example.com" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1.5">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" class="w-full px-3 py-2.5 pr-10 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="••••••••" required>
                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.29 3.29m0 0L3 3m3.29 3.29L12 12m-5.71-5.71L12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-[#65B741] hover:text-[#4d8a32] font-medium">Forgot password?</a>
                </div>

                <button type="submit" class="w-full py-2.5 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition-colors mt-4">
                    Sign In
                </button>

                <div class="text-center pt-4 border-t border-gray-200 mt-4">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-semibold text-[#65B741] hover:text-[#4d8a32] transition-colors">
                            Sign up
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const eyeOffIcon = document.getElementById('eyeOffIcon');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icons
            if (type === 'text') {
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        });
    }
});
</script>

<style>
    /* Hide footer on login page */
    footer {
        display: none !important;
    }
</style>
@endsection
