@extends('layouts.app')

@section('title', 'Register - Community Hub')

@section('content')
<div class="min-h-[calc(100vh-5rem)] flex items-center justify-center px-4 sm:px-6 lg:px-8" style="padding-top: 5rem !important;">
    <div class="max-w-2xl w-full">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Join Community Hub</h1>
            <div class="w-32 h-1.5 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-2 mx-auto"></div>
            <p class="text-sm text-gray-600">Create your account to participate in community activities</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
            <form method="POST" action="{{ route('register') }}" class="space-y-3">
                @csrf
                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-900 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="John Doe" required>
                        @error('name')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-900 mb-1">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="you@example.com" required>
                        @error('email')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-900 mb-1">Contact Number <span class="text-red-500">*</span></label>
                        <input type="tel" name="contact_number" value="{{ old('contact_number') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="0912-345-6789" required>
                        @error('contact_number')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-900 mb-1">Voters ID <span class="text-red-500">*</span></label>
                        <input type="text" name="voters_id" id="voters_id" maxlength="22" pattern="[A-Za-z0-9]{22}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white uppercase" placeholder="Enter 22-character Voters ID" required>
                        <p class="text-xs text-gray-500 mt-1">Must be exactly 22 alphanumeric characters</p>
                        @error('voters_id')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-900 mb-1">Address <span class="text-red-500">*</span></label>
                    <input type="text" name="address" value="{{ old('address') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="Block 5, Main Street" required>
                    @error('address')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-900 mb-1">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" name="password" id="password" class="w-full px-3 py-2 pr-10 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="••••••••" required>
                            <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eyeOffIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.29 3.29m0 0L3 3m3.29 3.29L12 12m-5.71-5.71L12 12" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-900 mb-1">Confirm Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="confirmPassword" class="w-full px-3 py-2 pr-10 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="••••••••" required>
                            <button type="button" id="toggleConfirmPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg id="eyeIconConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eyeOffIconConfirm" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.29 3.29m0 0L3 3m3.29 3.29L12 12m-5.71-5.71L12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-start pt-1">
                    <input type="checkbox" id="terms" class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900 mt-0.5 flex-shrink-0" required>
                    <label for="terms" class="ml-2 text-xs text-gray-600 leading-tight">
                        I agree to the <a href="{{ route('terms-of-service') }}" target="_blank" class="text-[#65B741] hover:text-[#4d8a32] font-medium">Terms of Service</a> and <a href="{{ route('privacy-policy') }}" target="_blank" class="text-[#65B741] hover:text-[#4d8a32] font-medium">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="w-full py-2 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition-colors mt-2">
                    Create Account
                </button>

                <div class="text-center pt-3 border-t border-gray-200 mt-3">
                    <p class="text-xs text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-semibold text-[#65B741] hover:text-[#4d8a32] transition-colors">
                            Sign in
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const eyeOffIcon = document.getElementById('eyeOffIcon');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        });
    }

    // Confirm Password toggle
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const eyeIconConfirm = document.getElementById('eyeIconConfirm');
    const eyeOffIconConfirm = document.getElementById('eyeOffIconConfirm');

    if (toggleConfirmPassword && confirmPasswordInput) {
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIconConfirm.classList.add('hidden');
                eyeOffIconConfirm.classList.remove('hidden');
            } else {
                eyeIconConfirm.classList.remove('hidden');
                eyeOffIconConfirm.classList.add('hidden');
            }
        });
    }

    // Voters ID validation
    const votersIdInput = document.getElementById('voters_id');
    if (votersIdInput) {
        votersIdInput.addEventListener('input', function(e) {
            // Remove any non-alphanumeric characters
            let value = e.target.value.replace(/[^A-Za-z0-9]/g, '');
            // Limit to 22 characters
            value = value.substring(0, 22);
            // Convert to uppercase
            e.target.value = value.toUpperCase();
        });

        votersIdInput.addEventListener('blur', function(e) {
            const value = e.target.value;
            if (value.length !== 22) {
                e.target.setCustomValidity('Voters ID must be exactly 22 alphanumeric characters');
            } else {
                e.target.setCustomValidity('');
            }
        });
    }
});
</script>

<style>
    /* Hide footer on register page */
    footer {
        display: none !important;
    }
</style>
@endsection

