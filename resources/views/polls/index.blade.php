@extends('layouts.app')

@section('title', 'Community Polls - Community Hub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8" data-aos="fade-down">
        <h1 class="text-3xl md:text-4xl font-bold text-text-primary mb-2">Community Polls</h1>
        <p class="text-text-secondary">Participate in community decisions and voice your opinion</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        @php
            $polls = [
                ['id' => 1, 'question' => 'Preferred Day for Community Market', 'description' => 'Which day works best for a weekly community market?', 'deadline' => 'Dec 15, 2024', 'status' => 'open', 'votes' => 234],
                ['id' => 2, 'question' => 'Community Garden Location', 'description' => 'Where should we establish the new community garden?', 'deadline' => 'Dec 20, 2024', 'status' => 'open', 'votes' => 156],
                ['id' => 3, 'question' => 'Festival Theme for New Year', 'description' => 'What theme should we use for the New Year festival?', 'deadline' => 'Nov 30, 2024', 'status' => 'closed', 'votes' => 312],
            ];
        @endphp

        @foreach($polls as $poll)
        <a href="{{ route('polls.show', $poll['id']) }}" class="block group">
            <div class="modern-card p-6 hover-lift" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="flex items-center justify-between mb-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                        @if($poll['status'] === 'open') bg-accent-beige-light text-text-secondary
                        @else bg-gray-200 text-text-secondary @endif">
                        {{ ucfirst($poll['status']) }}
                    </span>
                    <span class="text-sm text-text-muted">Deadline: {{ $poll['deadline'] }}</span>
                </div>
                <h3 class="text-xl font-bold text-text-primary mb-2 group-hover:text-primary transition-colors">{{ $poll['question'] }}</h3>
                <p class="text-text-secondary mb-4">{{ $poll['description'] }}</p>
                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                    <span class="text-sm text-text-muted">{{ $poll['votes'] }} votes</span>
                    <div class="flex items-center space-x-2">
                        <span class="text-xs text-text-muted">* Login to vote</span>
                        <span class="text-primary font-semibold text-sm group-hover:underline">
                            @if($poll['status'] === 'open') Vote Now →
                            @else View Results →
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection

