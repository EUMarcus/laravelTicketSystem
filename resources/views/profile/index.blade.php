@extends('layouts.app')

@section('title', 'My Profile - Community Hub')

@section('content')
@auth
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">My Profile</h1>
        <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
        <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Manage your account details and preferences</p>
    </div>

    @if(session('success'))
        <div class="mb-6">
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Profile Information Card -->
    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm mb-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Account Information</h2>
        
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Role</label>
                <input type="text" value="{{ ucfirst($profile->role) }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" disabled>
            </div>

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Voters ID</label>
                    <input type="text" name="voters_id" value="{{ old('voters_id', strtoupper($user->voters_id ?? '')) }}" maxlength="22" pattern="[A-Za-z0-9]{22}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white uppercase" placeholder="Enter 22-character Voters ID">
                    <p class="text-xs text-gray-500 mt-1">Must be exactly 22 alphanumeric characters</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Contact Number</label>
                    <input type="tel" name="contact_number" value="{{ old('contact_number', $user->contact_number ?? '') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="Enter your contact number">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Address</label>
                <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="Enter your address">
            </div>

            <div class="border-t border-gray-200 pt-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Change Password (Optional)</h3>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">New Password</label>
                        <input type="password" name="password" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="Leave blank to keep current password">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white" placeholder="Confirm new password">
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">Leave password fields blank if you don't want to change it.</p>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-200">
                <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800">
                    Update Profile
                </button>
                <button type="button" id="deleteAccountBtn" class="px-8 py-3 border-2 border-red-500 text-red-600 font-semibold rounded-lg hover:bg-red-50">
                    Delete Account
                </button>
            </div>
        </form>
    </div>

    <!-- Account Statistics -->
    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 mb-4">My Reports</h3>
            <div class="text-3xl font-bold text-gray-900 mb-2">{{ $ticketsCount }}</div>
            <p class="text-sm text-gray-600">Total reports submitted</p>
            <a href="{{ route('reports.index') }}" class="block mt-4 text-sm text-[#65B741] hover:text-[#4d8a32] font-semibold">View All Reports →</a>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 mb-4">My Suggestions</h3>
            <div class="text-3xl font-bold text-gray-900 mb-2">{{ $suggestionsCount }}</div>
            <p class="text-sm text-gray-600">Total suggestions submitted</p>
            <a href="{{ route('suggestions.index') }}" class="block mt-4 text-sm text-[#65B741] hover:text-[#4d8a32] font-semibold">View All Suggestions →</a>
        </div>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2 text-center">Delete Account</h3>
        <p class="text-gray-600 mb-6 text-center">Are you sure you want to delete your account? This action cannot be undone and will permanently remove all your data.</p>
        <form action="{{ route('profile.destroy') }}" method="POST" id="deleteAccountForm">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" id="cancelDeleteBtn" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700">
                    Delete Account
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteAccountBtn = document.getElementById('deleteAccountBtn');
    const deleteModal = document.getElementById('deleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const deleteAccountForm = document.getElementById('deleteAccountForm');

    // Voters ID validation and uppercase conversion
    const profileVotersIdInput = document.querySelector('input[name="voters_id"]');
    if (profileVotersIdInput) {
        profileVotersIdInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^A-Za-z0-9]/g, '');
            value = value.substring(0, 22);
            e.target.value = value.toUpperCase();
        });

        profileVotersIdInput.addEventListener('blur', function(e) {
            const value = e.target.value;
            if (value && value.length !== 22) {
                e.target.setCustomValidity('Voters ID must be exactly 22 alphanumeric characters');
            } else {
                e.target.setCustomValidity('');
            }
        });
    }

    // Handle delete account button click
    deleteAccountBtn.addEventListener('click', function() {
        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');
    });

    // Cancel delete
    cancelDeleteBtn.addEventListener('click', function() {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
    });

    // Confirm delete
    deleteAccountForm.addEventListener('submit', function(e) {
        if (!confirm('Are you absolutely sure? This will permanently delete your account and all associated data.')) {
            e.preventDefault();
        }
    });

    // Close modal when clicking outside
    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
        }
    });
});
</script>
@else
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm text-center">
        <div class="max-w-md mx-auto">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-[#65B741]/10 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-[#65B741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Login Required</h3>
            <p class="text-gray-600 mb-6">You need to be logged in to view your profile.</p>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('login') }}" class="px-8 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800">
                    Login
                </a>
                <a href="{{ route('register') }}" class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50">
                    Register
                </a>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection
