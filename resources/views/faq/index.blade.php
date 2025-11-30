@extends('layouts.app')

@section('title', 'FAQ - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 2rem;">
    <!-- Header -->
    <div class="mb-10">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h1>
            <div class="w-40 h-2 bg-gradient-to-r from-[#65B741] via-[#65B741] to-transparent rounded-full mb-4"></div>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl">Find answers to common questions about our community services</p>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <input type="text" id="faqSearch" placeholder="Search questions..." class="w-full px-4 py-2 pl-10 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none" style="background-color: white !important; color: #111827 !important;">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <div class="flex items-center gap-3 flex-wrap">
                <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Filter:</span>
                <button onclick="filterByCategory('all')" class="category-filter px-4 py-2 rounded-lg text-sm font-semibold transition-colors bg-gray-900 text-white" data-category="all">
                    All
                </button>
                <button onclick="filterByCategory('Reporting & Tickets')" class="category-filter px-4 py-2 rounded-lg text-sm font-semibold transition-colors bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400" data-category="Reporting & Tickets">
                    Reports
                </button>
                <button onclick="filterByCategory('Barangay Documents')" class="category-filter px-4 py-2 rounded-lg text-sm font-semibold transition-colors bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400" data-category="Barangay Documents">
                    Documents
                </button>
                <button onclick="filterByCategory('Events & Programs')" class="category-filter px-4 py-2 rounded-lg text-sm font-semibold transition-colors bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400" data-category="Events & Programs">
                    Events
                </button>
                <button onclick="filterByCategory('Contact')" class="category-filter px-4 py-2 rounded-lg text-sm font-semibold transition-colors bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400" data-category="Contact">
                    Contact
                </button>
            </div>
        </div>
    </div>

    <!-- FAQ Accordion -->
    <div id="faqContainer" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($faqs as $index => $faq)
            <div class="faq-item bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:border-gray-300 hover:shadow-md transition-all" data-category="{{ $faq->category }}" style="min-height: fit-content;">
                <button onclick="toggleFaq({{ $index }})" class="w-full p-5 text-left flex flex-col hover:bg-gray-50 transition-colors" id="faq-button-{{ $index }}">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                            {{ $faq->category }}
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-3">{{ $faq->question }}</h3>
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <span class="text-xs text-gray-500">Click to expand</span>
                        <svg class="w-5 h-5 text-gray-500 flex-shrink-0 faq-icon" id="faq-icon-{{ $index }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </button>
                <div class="faq-answer hidden px-5 pb-5" id="faq-answer-{{ $index }}">
                    <div class="pt-2 border-t border-gray-100">
                        <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $faq->answer }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- No Results Message -->
    <div id="noResults" class="hidden text-center py-12">
        <p class="text-gray-500 text-lg">No questions found matching your search.</p>
    </div>
</div>

<script>
function toggleFaq(index) {
    const answer = document.getElementById(`faq-answer-${index}`);
    const icon = document.getElementById(`faq-icon-${index}`);
    const button = document.getElementById(`faq-button-${index}`);
    const faqItem = button.closest('.faq-item');
    
    if (answer.classList.contains('hidden')) {
        // Close all other FAQs
        document.querySelectorAll('.faq-answer').forEach(item => {
            if (!item.classList.contains('hidden') && item.id !== `faq-answer-${index}`) {
                item.classList.add('hidden');
                const otherIndex = item.id.split('-')[2];
                const otherItem = document.getElementById(`faq-button-${otherIndex}`).closest('.faq-item');
                document.getElementById(`faq-icon-${otherIndex}`).classList.remove('rotate-180');
                document.getElementById(`faq-button-${otherIndex}`).classList.remove('bg-gray-50');
                if (otherItem) {
                    otherItem.style.height = '';
                }
            }
        });
        
        // Open this FAQ
        answer.classList.remove('hidden');
        icon.classList.add('rotate-180');
        button.classList.add('bg-gray-50');
        
        // Allow the card to expand naturally
        if (faqItem) {
            faqItem.style.height = 'auto';
        }
    } else {
        // Close this FAQ
        answer.classList.add('hidden');
        icon.classList.remove('rotate-180');
        button.classList.remove('bg-gray-50');
        
        // Reset height
        if (faqItem) {
            faqItem.style.height = '';
        }
    }
}

function filterByCategory(category) {
    const faqItems = document.querySelectorAll('.faq-item');
    const categoryFilters = document.querySelectorAll('.category-filter');
    let visibleCount = 0;
    
    // Update filter button styles
    categoryFilters.forEach(btn => {
        if (btn.dataset.category === category) {
            btn.classList.remove('bg-white', 'border', 'border-gray-300', 'text-gray-700');
            btn.classList.add('bg-gray-900', 'text-white');
        } else {
            btn.classList.remove('bg-gray-900', 'text-white');
            btn.classList.add('bg-white', 'border', 'border-gray-300', 'text-gray-700');
        }
    });
    
    // Filter FAQs
    faqItems.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = '';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    const noResults = document.getElementById('noResults');
    if (visibleCount === 0) {
        noResults.classList.remove('hidden');
    } else {
        noResults.classList.add('hidden');
    }
}

// Search functionality
document.getElementById('faqSearch').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item');
    let visibleCount = 0;
    
    faqItems.forEach(item => {
        const question = item.querySelector('h3').textContent.toLowerCase();
        const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
        const category = item.dataset.category.toLowerCase();
        
        if (question.includes(searchTerm) || answer.includes(searchTerm) || category.includes(searchTerm)) {
            item.style.display = '';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    const noResults = document.getElementById('noResults');
    if (visibleCount === 0 && searchTerm !== '') {
        noResults.classList.remove('hidden');
    } else {
        noResults.classList.add('hidden');
    }
});
</script>

<style>
.faq-icon {
    transition: transform 0.3s ease;
}
.faq-icon.rotate-180 {
    transform: rotate(180deg);
}
</style>
@endsection
