<!-- New Suggestion Modal -->
<div id="suggestionModal" class="fixed inset-0 z-[9999] hidden" style="z-index: 9999 !important;">
    <!-- Background overlay - green with transparency -->
    <div class="fixed inset-0 bg-[#65B741] bg-opacity-20" id="suggestionModalOverlay" style="backdrop-filter: blur(2px);"></div>
    
    <!-- Modal container -->
    <div class="fixed inset-0 flex items-center justify-center p-4" style="pointer-events: none;">
        <!-- Modal panel -->
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-lg relative z-10" style="pointer-events: auto; max-height: 90vh; overflow-y: auto;">
            <form id="suggestionForm">
                <!-- Header -->
                <div class="px-5 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Share Your Suggestion</h3>
                        <p class="text-xs text-gray-600 mt-1">Help improve our community with your ideas</p>
                    </div>
                    <button type="button" id="closeSuggestionModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="px-5 py-4 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Your Name <span class="text-gray-400 font-normal">(Optional)</span></label>
                        <input type="text" id="suggestionUserName" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none" placeholder="Enter your name (optional)">
                        <p class="text-xs text-gray-500 mt-1">We'll remember your name for future suggestions and comments</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Category <span class="text-gray-400 font-normal">(Optional)</span></label>
                        <select name="category" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none bg-white">
                            <option value="">Select Category</option>
                            <option value="Health">Health</option>
                            <option value="Infrastructure">Infrastructure</option>
                            <option value="Events">Events</option>
                            <option value="Education">Education</option>
                            <option value="Environment">Environment</option>
                            <option value="Sports">Sports</option>
                            <option value="Safety">Safety</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none" placeholder="Brief title for your suggestion">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="5" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none resize-none" placeholder="Describe your suggestion in detail..."></textarea>
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="anonymous" class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                            <span class="ml-2 text-sm text-gray-700">Submit as Anonymous</span>
                        </label>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-5 py-3 border-t border-gray-200 flex gap-3">
                    <button type="button" id="cancelSuggestionModal" class="px-6 py-2.5 border-2 border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-8 py-2.5 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 flex-1">
                        Submit Suggestion
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    const modal = document.getElementById('suggestionModal');
    const openBtn = document.getElementById('openSuggestionModal');
    const closeBtn = document.getElementById('closeSuggestionModal');
    const cancelBtn = document.getElementById('cancelSuggestionModal');
    const overlay = document.getElementById('suggestionModalOverlay');
    const form = document.getElementById('suggestionForm');

    if (!modal || !openBtn) {
        console.error('Modal elements not found');
        return;
    }

    function openModal() {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        if (form) {
            form.reset();
        }
    }

    // Open modal
    openBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        openModal();
    });

    // Close modal
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', closeModal);
    }

    if (overlay) {
        overlay.addEventListener('click', closeModal);
    }

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Handle form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Save user name if provided
            const nameInput = document.getElementById('suggestionUserName');
            if (nameInput && nameInput.value.trim()) {
                if (window.TemporaryAuth) {
                    const auth = new window.TemporaryAuth();
                    auth.setUserName(nameInput.value.trim());
                }
            }
            
            alert('Suggestion submitted successfully! (This is a demo - will save to Supabase later)');
            closeModal();
        });
    }
})();
</script>
