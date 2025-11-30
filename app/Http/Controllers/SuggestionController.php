<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\SuggestionComment;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SuggestionController extends Controller
{
    public function index()
    {
        try {
            $query = Suggestion::with(['author', 'comments'])->latest();
            
            $sortBy = request('sort', 'newest');
            if ($sortBy === 'liked') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sortBy === 'discussed') {
                $query->withCount('comments')->orderBy('comments_count', 'desc');
            } else {
                $query->orderBy('created_at', 'desc');
            }
            
            $suggestions = $query->get()->map(function($suggestion) {
                return [
                    'id' => $suggestion->id,
                    'title' => $suggestion->title,
                    'category' => $suggestion->category ?? 'Other',
                    'date' => $suggestion->created_at->diffForHumans(),
                    'created_at' => $suggestion->created_at->format('Y-m-d'),
                    'author' => $suggestion->author ? $suggestion->author->name : 'Anonymous',
                    'upvotes' => 0,
                    'comments' => $suggestion->comments->count(),
                    'status' => $suggestion->status ?? 'pending',
                ];
            });
            
            if ($sortBy === 'liked') {
                $suggestions = $suggestions->sortByDesc('upvotes')->values();
            } elseif ($sortBy === 'discussed') {
                $suggestions = $suggestions->sortByDesc('comments')->values();
            }
            $perPage = 6;
            $currentPage = request('page', 1);
            $suggestions = new \Illuminate\Pagination\LengthAwarePaginator(
                $suggestions->forPage($currentPage, $perPage),
                $suggestions->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
            return view('suggestions.index', compact('suggestions'));
        } catch (\Exception $e) {
            \Log::error('Failed to fetch suggestions: ' . $e->getMessage());
            
            $hardcodedSuggestions = [
                ['id' => 1, 'title' => 'Weekly Community Exercise Program', 'category' => 'Health', 'upvotes' => 45, 'comments' => 12, 'author' => 'Maria Santos', 'date' => '3 days ago', 'created_at' => '2024-12-10'],
                ['id' => 2, 'title' => 'Install Solar-Powered Streetlights', 'category' => 'Infrastructure', 'upvotes' => 89, 'comments' => 23, 'author' => 'Anonymous', 'date' => '1 week ago', 'created_at' => '2024-12-03'],
                ['id' => 3, 'title' => 'Monthly Barangay Festival', 'category' => 'Events', 'upvotes' => 156, 'comments' => 34, 'author' => 'Juan Dela Cruz', 'date' => '2 weeks ago', 'created_at' => '2024-11-26'],
            ];
            
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
            $query = Suggestion::with(['author', 'comments'])->latest();
            
            $sortBy = request('sort', 'newest');
            if ($sortBy === 'liked') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sortBy === 'discussed') {
                $query->withCount('comments')->orderBy('comments_count', 'desc');
            } else {
                $query->orderBy('created_at', 'desc');
            }
            
            $suggestions = $query->get()->map(function($suggestion) {
                return [
                    'id' => $suggestion->id,
                    'title' => $suggestion->title,
                    'category' => $suggestion->category ?? 'Other',
                    'date' => $suggestion->created_at->diffForHumans(),
                    'created_at' => $suggestion->created_at->format('Y-m-d'),
                    'author' => $suggestion->author ? $suggestion->author->name : 'Anonymous',
                    'upvotes' => 0,
                    'comments' => $suggestion->comments->count(),
                    'status' => $suggestion->status ?? 'pending',
                ];
            });
            
            if ($sortBy === 'liked') {
                $suggestions = $suggestions->sortByDesc('upvotes')->values();
            } elseif ($sortBy === 'discussed') {
                $suggestions = $suggestions->sortByDesc('comments')->values();
            }
            $perPage = 6;
            $currentPage = request('page', 1);
            $suggestions = new \Illuminate\Pagination\LengthAwarePaginator(
                $suggestions->forPage($currentPage, $perPage),
                $suggestions->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
            return view('staff.suggestions', compact('suggestions'));
        } catch (\Exception $e) {
            \Log::error('Failed to fetch suggestions for staff: ' . $e->getMessage());
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
            $suggestion = Suggestion::with(['author', 'comments.author'])->findOrFail($id);
            
            $formattedComments = $suggestion->comments->map(function($comment) {
                $authorName = 'Anonymous';
                $isStaff = false;
                
                if ($comment->author) {
                    $authorName = $comment->author->name;
                    if (in_array($comment->author->role, ['employee', 'admin'])) {
                        $isStaff = true;
                        $authorName = 'Staff ' . $authorName;
                    }
                }
                
                return [
                    'id' => $comment->id,
                    'text' => $comment->comment,
                    'date' => $comment->created_at->diffForHumans(),
                    'author' => $authorName,
                    'comment_from' => $comment->comment_from,
                    'is_staff' => $isStaff,
                ];
            });
            
            $formattedSuggestion = [
                'id' => $suggestion->id,
                'title' => $suggestion->title,
                'category' => $suggestion->category ?? 'Other',
                'date' => $suggestion->created_at->diffForHumans(),
                'created_at' => $suggestion->created_at->format('Y-m-d'),
                'author' => $suggestion->author ? $suggestion->author->name : 'Anonymous',
                'content' => $suggestion->full_content,
                'upvotes' => 0,
                'comments' => $formattedComments->count(),
                'status' => $suggestion->status ?? 'pending',
            ];
            
            return view('suggestions.show', [
                'suggestion' => $formattedSuggestion,
                'comments' => $formattedComments
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in suggestion show method', [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);
            
            $hardcodedSuggestions = [
                ['id' => 1, 'title' => 'Weekly Community Exercise Program', 'category' => 'Health', 'date' => '3 days ago', 'created_at' => '2024-12-10', 'author' => 'Maria Santos', 'content' => 'I suggest we organize a weekly community exercise program to promote health and wellness among residents. This could include activities like morning walks, yoga sessions, or group fitness classes.', 'upvotes' => 45, 'comments' => 12],
                ['id' => 2, 'title' => 'Install Solar-Powered Streetlights', 'category' => 'Infrastructure', 'date' => '1 week ago', 'created_at' => '2024-12-03', 'author' => 'Anonymous', 'content' => 'I recommend installing solar-powered streetlights in our community to improve safety and reduce energy costs.', 'upvotes' => 89, 'comments' => 23],
                ['id' => 3, 'title' => 'Monthly Barangay Festival', 'category' => 'Events', 'date' => '2 weeks ago', 'created_at' => '2024-11-26', 'author' => 'Juan Dela Cruz', 'content' => 'I propose organizing a monthly barangay festival to bring the community together and celebrate our local culture.', 'upvotes' => 156, 'comments' => 34],
            ];
            
            $suggestion = collect($hardcodedSuggestions)->firstWhere('id', (int)$id);
            
            if (!$suggestion) {
                abort(404, 'Suggestion not found');
            }
            
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
        if (!session('user')) {
            return redirect()->route('login')
                ->withErrors(['message' => 'You must be logged in to comment.']);
        }

        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $userId = session('user')['id'] ?? null;
        
        try {
            $suggestion = Suggestion::findOrFail($id);
            
            $comment = SuggestionComment::create([
                'id' => (string) Str::uuid(),
                'suggestion_id' => $id,
                'comment_from' => $userId,
                'comment' => $validated['comment'],
            ]);
            
            return redirect()->route('suggestions.show', $id);
        } catch (\Exception $e) {
            \Log::error('Failed to save comment: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Failed to post comment. Please try again.']);
        }
    }

    public function store(Request $request)
    {
        if (!session('user')) {
            return redirect()->route('login')
                ->withErrors(['message' => 'You must be logged in to submit a suggestion.']);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $userId = session('user')['id'] ?? null;
        
        try {
            $suggestion = Suggestion::create([
                'id' => (string) Str::uuid(),
                'title' => $validated['title'],
                'category' => $validated['category'] ?? null,
                'full_content' => $validated['description'],
                'posted_by' => $userId,
                'status' => 'pending',
            ]);
            
            return redirect()->route('suggestions.index')
                ->with('success', 'Suggestion submitted successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to save suggestion: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Failed to submit suggestion. Please try again.']);
        }
    }

    public function edit($id)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can edit suggestions.');
        }

        try {
            $suggestion = Suggestion::findOrFail($id);
            
            return view('suggestions.edit', [
                'suggestion' => [
                    'suggest_id' => $suggestion->id,
                    'title' => $suggestion->title,
                    'category' => $suggestion->category ?? '',
                    'full_content' => $suggestion->full_content,
                ]
            ]);
        } catch (\Exception $e) {
            abort(404, 'Suggestion not found: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can edit suggestions.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        try {
            $suggestion = Suggestion::findOrFail($id);
            
            $suggestion->update([
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

    public function updateStatus(Request $request, $id)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can update suggestion status.');
        }

        $validated = $request->validate([
            'status' => ['required', 'in:pending,considering,processing,approved,rejected'],
        ]);

        try {
            $suggestion = Suggestion::findOrFail($id);
            
            $suggestion->update([
                'status' => $validated['status'],
            ]);

            return redirect()->back()
                ->with('success', 'Suggestion status updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to update suggestion status: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['message' => 'Failed to update suggestion status. Please try again.']);
        }
    }

    public function destroy($id)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can delete suggestions.');
        }

        try {
            $suggestion = Suggestion::findOrFail($id);
            $suggestion->comments()->delete();
            $suggestion->delete();

            return redirect()->route('staff.suggestions')
                ->with('success', 'Suggestion deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to delete suggestion: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['message' => 'Failed to delete suggestion. Please try again.']);
        }
    }
}
