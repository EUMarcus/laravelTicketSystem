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
            
            // Get all suggestion IDs
            $suggestionIds = array_column($suggestions, 'suggest_id');
            
            // Fetch comment counts for all suggestions
            $commentCounts = [];
            if (!empty($suggestionIds)) {
                foreach ($suggestionIds as $suggestionId) {
                    try {
                        $comments = $this->supabase->select('suggestion_comments', ['suggestion_id' => $suggestionId], 'scom_id');
                        $commentCounts[$suggestionId] = count($comments);
                    } catch (\Exception $e) {
                        $commentCounts[$suggestionId] = 0;
                    }
                }
            }
            
            // Get all unique user IDs from suggestions
            $userIds = array_filter(array_unique(array_column($suggestions, 'posted_by')));
            
            // Fetch user names from profiles
            $userNames = [];
            if (!empty($userIds)) {
                $profiles = \App\Models\Profile::whereIn('id', $userIds)->get();
                foreach ($profiles as $profile) {
                    $userNames[$profile->id] = $profile->name;
                }
            }
            
            // Transform data to match view expectations
            $formattedSuggestions = array_map(function($suggestion) use ($commentCounts, $userNames) {
                // Format date
                $date = isset($suggestion['created_at']) 
                    ? Carbon::parse($suggestion['created_at'])->diffForHumans()
                    : 'Just now';
                
                // Get author name
                $author = 'Anonymous';
                if (isset($suggestion['posted_by']) && isset($userNames[$suggestion['posted_by']])) {
                    $author = $userNames[$suggestion['posted_by']];
                }
                
                // Get comment count
                $commentCount = $commentCounts[$suggestion['suggest_id']] ?? 0;
                
                return [
                    'id' => $suggestion['suggest_id'],
                    'title' => $suggestion['title'],
                    'category' => $suggestion['category'] ?? 'Other',
                    'date' => $date,
                    'created_at' => isset($suggestion['created_at']) 
                        ? Carbon::parse($suggestion['created_at'])->format('Y-m-d')
                        : now()->format('Y-m-d'),
                    'author' => $author,
                    'upvotes' => 0, // Upvotes are currently stored in localStorage, would need a votes table for proper counting
                    'comments' => $commentCount,
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

    public function staffIndex()
    {
        try {
            // Fetch suggestions from Supabase, ordered by created_at descending
            $suggestions = $this->supabase->select('suggestions', [], 'suggest_id,title,category,full_content,created_at,posted_by', 'created_at', 'desc');
            
            // Get all suggestion IDs
            $suggestionIds = array_column($suggestions, 'suggest_id');
            
            // Fetch comment counts for all suggestions
            $commentCounts = [];
            if (!empty($suggestionIds)) {
                foreach ($suggestionIds as $suggestionId) {
                    try {
                        $comments = $this->supabase->select('suggestion_comments', ['suggestion_id' => $suggestionId], 'scom_id');
                        $commentCounts[$suggestionId] = count($comments);
                    } catch (\Exception $e) {
                        $commentCounts[$suggestionId] = 0;
                    }
                }
            }
            
            // Get all unique user IDs from suggestions
            $userIds = array_filter(array_unique(array_column($suggestions, 'posted_by')));
            
            // Fetch user names from profiles
            $userNames = [];
            if (!empty($userIds)) {
                $profiles = \App\Models\Profile::whereIn('id', $userIds)->get();
                foreach ($profiles as $profile) {
                    $userNames[$profile->id] = $profile->name;
                }
            }
            
            // Transform data to match view expectations
            $formattedSuggestions = array_map(function($suggestion) use ($commentCounts, $userNames) {
                // Format date
                $date = isset($suggestion['created_at']) 
                    ? Carbon::parse($suggestion['created_at'])->diffForHumans()
                    : 'Just now';
                
                // Get author name
                $author = 'Anonymous';
                if (isset($suggestion['posted_by']) && isset($userNames[$suggestion['posted_by']])) {
                    $author = $userNames[$suggestion['posted_by']];
                }
                
                // Get comment count
                $commentCount = $commentCounts[$suggestion['suggest_id']] ?? 0;
                
                return [
                    'id' => $suggestion['suggest_id'], // Use UUID from Supabase
                    'title' => $suggestion['title'],
                    'category' => $suggestion['category'] ?? 'Other',
                    'date' => $date,
                    'created_at' => isset($suggestion['created_at']) 
                        ? Carbon::parse($suggestion['created_at'])->format('Y-m-d')
                        : now()->format('Y-m-d'),
                    'author' => $author,
                    'upvotes' => 0, // Upvotes are currently stored in localStorage, would need a votes table for proper counting
                    'comments' => $commentCount,
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
            
            return view('staff.suggestions', compact('suggestions'));
        } catch (\Exception $e) {
            \Log::error('Failed to fetch suggestions for staff: ' . $e->getMessage());
            // Return empty paginator on error
            $suggestions = new \Illuminate\Pagination\LengthAwarePaginator(
                [],
                0,
                6,
                1,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            return view('staff.suggestions', compact('suggestions'))->withErrors(['message' => 'Failed to load suggestions. Please try again.']);
        }
    }

    public function show($id)
    {
        try {
            // Fetch suggestion from Supabase
            $suggestions = $this->supabase->select('suggestions', ['suggest_id' => $id], 'suggest_id,title,category,full_content,created_at,posted_by');
            
            if (empty($suggestions)) {
                abort(404, 'Suggestion not found');
            }
            
            $suggestion = $suggestions[0];
            
            // Fetch comments for this suggestion
            $comments = $this->supabase->select('suggestion_comments', ['suggestion_id' => $id], 'scom_id,comment,created_at,comment_from', 'created_at', 'asc');
            
            // Get all unique user IDs from comments
            $userIds = array_filter(array_unique(array_column($comments, 'comment_from')));
            
            // Fetch user names from profiles
            $userNames = [];
            if (!empty($userIds)) {
                $profiles = \App\Models\Profile::whereIn('id', $userIds)->get();
                foreach ($profiles as $profile) {
                    $userNames[$profile->id] = $profile->name;
                }
            }
            
            // Format comments
            $formattedComments = array_map(function($comment) use ($userNames) {
                $authorName = 'Anonymous';
                if (isset($comment['comment_from']) && isset($userNames[$comment['comment_from']])) {
                    $authorName = $userNames[$comment['comment_from']];
                }
                
                return [
                    'id' => $comment['scom_id'],
                    'text' => $comment['comment'],
                    'date' => isset($comment['created_at']) 
                        ? Carbon::parse($comment['created_at'])->diffForHumans()
                        : 'Just now',
                    'author' => $authorName,
                    'comment_from' => $comment['comment_from'] ?? null,
                ];
            }, $comments);
            
            // Format date
            $date = isset($suggestion['created_at']) 
                ? Carbon::parse($suggestion['created_at'])->diffForHumans()
                : 'Just now';
            
            // Get author name (for now, use "Anonymous" if no posted_by)
            $author = 'Anonymous';
            if (isset($suggestion['posted_by'])) {
                // In a real app, you'd fetch the user's name from a users table
                $author = 'Anonymous';
            }
            
            // Transform to match view expectations
            $formattedSuggestion = [
                'id' => $suggestion['suggest_id'],
                'title' => $suggestion['title'],
                'category' => $suggestion['category'] ?? 'Other',
                'date' => $date,
                'created_at' => isset($suggestion['created_at']) 
                    ? Carbon::parse($suggestion['created_at'])->format('Y-m-d')
                    : now()->format('Y-m-d'),
                'author' => $author,
                'content' => $suggestion['full_content'],
                'upvotes' => 0, // Not in database schema yet
                'comments' => count($formattedComments),
            ];
            
            return view('suggestions.show', [
                'suggestion' => $formattedSuggestion,
                'comments' => $formattedComments
            ]);
        } catch (\Exception $e) {
            // Fallback to hardcoded data
            $hardcodedSuggestions = [
                ['id' => 1, 'title' => 'Weekly Community Exercise Program', 'category' => 'Health', 'date' => '3 days ago', 'created_at' => '2024-12-10', 'author' => 'Maria Santos', 'content' => 'I suggest we organize a weekly community exercise program to promote health and wellness among residents. This could include activities like morning walks, yoga sessions, or group fitness classes.', 'upvotes' => 45, 'comments' => 12],
                ['id' => 2, 'title' => 'Install Solar-Powered Streetlights', 'category' => 'Infrastructure', 'date' => '1 week ago', 'created_at' => '2024-12-03', 'author' => 'Anonymous', 'content' => 'I recommend installing solar-powered streetlights in our community to improve safety and reduce energy costs.', 'upvotes' => 89, 'comments' => 23],
                ['id' => 3, 'title' => 'Monthly Barangay Festival', 'category' => 'Events', 'date' => '2 weeks ago', 'created_at' => '2024-11-26', 'author' => 'Juan Dela Cruz', 'content' => 'I propose organizing a monthly barangay festival to bring the community together and celebrate our local culture.', 'upvotes' => 156, 'comments' => 34],
            ];
            
            $suggestion = collect($hardcodedSuggestions)->firstWhere('id', (int)$id);
            
            if (!$suggestion) {
                abort(404, 'Suggestion not found');
            }
            
            // Fallback comments
            $comments = [
                ['id' => 1, 'author' => 'Carlos Rivera', 'date' => '2 days ago', 'text' => 'Great idea! I would love to participate in this.'],
            ];
            
            return view('suggestions.show', [
                'suggestion' => $suggestion,
                'comments' => $comments
            ]);
        }
    }

    public function storeComment(Request $request, $id)
    {
        // Check if user is logged in
        if (!session('user')) {
            return redirect()->route('login')
                ->withErrors(['message' => 'You must be logged in to comment.']);
        }

        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        // Get user ID from session
        $userId = session('user')['id'] ?? null;
        
        // Prepare data for Supabase
        $commentData = [
            'suggestion_id' => $id,
            'comment' => $validated['comment'],
        ];

        // Add comment_from if user ID is available and is a valid UUID
        if ($userId && $this->isValidUuid($userId)) {
            $commentData['comment_from'] = $userId;
        }

        try {
            // Save to Supabase
            $result = $this->supabase->insert('suggestion_comments', $commentData);
            
            return redirect()->route('suggestions.show', $id);
        } catch (\Exception $e) {
            // Log error and redirect with error message
            \Log::error('Failed to save comment to Supabase: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Failed to post comment. Please try again.']);
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

    public function edit($id)
    {
        // Log that we're in the edit method
        \Log::info('=== SUGGESTION EDIT METHOD CALLED ===', [
            'id' => $id,
            'id_type' => gettype($id),
            'url' => request()->url(),
            'route_name' => request()->route()->getName(),
        ]);
        
        // Check if user is staff
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            \Log::warning('Unauthorized edit attempt', ['id' => $id, 'role' => session('user')['role'] ?? 'none']);
            abort(403, 'Only staff members can edit suggestions.');
        }

        try {
            // Check if Supabase is configured
            if (!$this->supabase->isConfigured()) {
                \Log::error('Supabase not configured');
                abort(500, 'Database not configured');
            }
            
            // Fetch from Supabase using UUID
            $suggestions = $this->supabase->select('suggestions', ['suggest_id' => $id], 'suggest_id,title,category,full_content');
            
            \Log::info('Supabase query result', ['id' => $id, 'count' => count($suggestions)]);
            
            if (empty($suggestions)) {
                \Log::warning('Suggestion not found in Supabase', ['id' => $id, 'id_type' => gettype($id)]);
                abort(404, 'Suggestion not found');
            }
            
            $suggestion = $suggestions[0];
            
            return view('suggestions.edit', [
                'suggestion' => [
                    'suggest_id' => $suggestion['suggest_id'],
                    'title' => $suggestion['title'],
                    'category' => $suggestion['category'] ?? '',
                    'full_content' => $suggestion['full_content'],
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching suggestion for edit', [
                'id' => $id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            abort(404, 'Suggestion not found: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        // Check if user is staff
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can edit suggestions.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        try {
            $this->supabase->update('suggestions', ['suggest_id' => $id], [
                'title' => $validated['title'],
                'category' => $validated['category'] ?? null,
                'full_content' => $validated['description'],
            ]);

            return redirect()->route('suggestions.show', $id)
                ->with('success', 'Suggestion updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to update suggestion: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Failed to update suggestion. Please try again.']);
        }
    }

    public function destroy($id)
    {
        // Check if user is staff
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can delete suggestions.');
        }

        try {
            // Delete comments first
            $this->supabase->delete('suggestion_comments', ['suggestion_id' => $id]);
            
            // Delete suggestion
            $this->supabase->delete('suggestions', ['suggest_id' => $id]);

            return redirect()->route('staff.suggestions')
                ->with('success', 'Suggestion deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to delete suggestion: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['message' => 'Failed to delete suggestion. Please try again.']);
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

