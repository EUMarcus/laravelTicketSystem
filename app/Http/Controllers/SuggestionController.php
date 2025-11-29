<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SuggestionController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        try {
            // Fetch suggestions from Supabase, ordered by created_at descending
            $suggestions = $this->supabase->select('suggestions', [], 'suggest_id,title,category,full_content,created_at,posted_by', 'created_at', 'desc');
            
            // Transform data to match view expectations
            $formattedSuggestions = array_map(function($suggestion) {
                // Format date
                $date = isset($suggestion['created_at']) 
                    ? Carbon::parse($suggestion['created_at'])->diffForHumans()
                    : 'Just now';
                
                // Get author name (for now, use "Anonymous" if no posted_by)
                $author = 'Anonymous';
                if (isset($suggestion['posted_by'])) {
                    // In a real app, you'd fetch the user's name from a users table
                    // For now, we'll use "Anonymous" or try to get from session
                    $author = 'Anonymous';
                }
                
                return [
                    'id' => $suggestion['suggest_id'],
                    'title' => $suggestion['title'],
                    'category' => $suggestion['category'] ?? 'Other',
                    'date' => $date,
                    'created_at' => isset($suggestion['created_at']) 
                        ? Carbon::parse($suggestion['created_at'])->format('Y-m-d')
                        : now()->format('Y-m-d'),
                    'author' => $author,
                    'upvotes' => 0, // Not in database schema yet
                    'comments' => 0, // Not in database schema yet
                ];
            }, $suggestions);
            
            // Apply sorting
            $sortBy = request('sort', 'newest');
            if ($sortBy === 'liked') {
                usort($formattedSuggestions, function($a, $b) {
                    return $b['upvotes'] - $a['upvotes'];
                });
            } elseif ($sortBy === 'discussed') {
                usort($formattedSuggestions, function($a, $b) {
                    return $b['comments'] - $a['comments'];
                });
            } else {
                // Newest (default) - already sorted by date
                usort($formattedSuggestions, function($a, $b) {
                    return strtotime($b['created_at']) - strtotime($a['created_at']);
                });
            }
            
            // Paginate
            $perPage = 6;
            $currentPage = request('page', 1);
            $total = count($formattedSuggestions);
            $offset = ($currentPage - 1) * $perPage;
            $paginatedSuggestions = array_slice($formattedSuggestions, $offset, $perPage);
            
            $suggestions = new \Illuminate\Pagination\LengthAwarePaginator(
                $paginatedSuggestions,
                $total,
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
            return view('suggestions.index', compact('suggestions'));
        } catch (\Exception $e) {
            // Fallback to hardcoded data if Supabase fails
            $hardcodedSuggestions = [
                ['id' => 1, 'title' => 'Weekly Community Exercise Program', 'category' => 'Health', 'upvotes' => 45, 'comments' => 12, 'author' => 'Maria Santos', 'date' => '3 days ago', 'created_at' => '2024-12-10'],
                ['id' => 2, 'title' => 'Install Solar-Powered Streetlights', 'category' => 'Infrastructure', 'upvotes' => 89, 'comments' => 23, 'author' => 'Anonymous', 'date' => '1 week ago', 'created_at' => '2024-12-03'],
                ['id' => 3, 'title' => 'Monthly Barangay Festival', 'category' => 'Events', 'upvotes' => 156, 'comments' => 34, 'author' => 'Juan Dela Cruz', 'date' => '2 weeks ago', 'created_at' => '2024-11-26'],
            ];
            
            // Apply sorting
            $sortBy = request('sort', 'newest');
            $sortedSuggestions = $hardcodedSuggestions;
            
            if ($sortBy === 'liked') {
                usort($sortedSuggestions, function($a, $b) {
                    return $b['upvotes'] - $a['upvotes'];
                });
            } elseif ($sortBy === 'discussed') {
                usort($sortedSuggestions, function($a, $b) {
                    return $b['comments'] - $a['comments'];
                });
            } else {
                usort($sortedSuggestions, function($a, $b) {
                    return strtotime($b['created_at']) - strtotime($a['created_at']);
                });
            }
            
            // Paginate
            $perPage = 6;
            $currentPage = request('page', 1);
            $total = count($sortedSuggestions);
            $offset = ($currentPage - 1) * $perPage;
            $paginatedSuggestions = array_slice($sortedSuggestions, $offset, $perPage);
            
            $suggestions = new \Illuminate\Pagination\LengthAwarePaginator(
                $paginatedSuggestions,
                $total,
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
            return view('suggestions.index', compact('suggestions'));
        }
    }

    public function store(Request $request)
    {
        // Check if user is logged in
        if (!session('user')) {
            return redirect()->route('login')
                ->withErrors(['message' => 'You must be logged in to submit a suggestion.']);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        // Get user ID from session
        $userId = session('user')['id'] ?? null;
        
        // Prepare data for Supabase
        $suggestionData = [
            'title' => $validated['title'],
            'category' => $validated['category'] ?? null,
            'full_content' => $validated['description'],
        ];

        // Add posted_by if user ID is available and is a valid UUID
        if ($userId && $this->isValidUuid($userId)) {
            $suggestionData['posted_by'] = $userId;
        }

        try {
            // Save to Supabase
            $result = $this->supabase->insert('suggestions', $suggestionData);
            
            return redirect()->route('suggestions.index')
                ->with('success', 'Suggestion submitted successfully!');
        } catch (\Exception $e) {
            // Log error and redirect with error message
            \Log::error('Failed to save suggestion to Supabase: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Failed to submit suggestion. Please try again.']);
        }
    }

    /**
     * Check if a string is a valid UUID
     */
    private function isValidUuid(string $uuid): bool
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $uuid) === 1;
    }
}

