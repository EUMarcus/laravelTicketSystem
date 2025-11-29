<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function store(Request $request)
    {
        // Check if user is staff
        if (!session('user') || session('user')['role'] !== 'employee') {
            abort(403, 'Only staff members can create announcements.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:Event,Health,Meeting,Service,Infrastructure,Safety,Education,Other'],
            'content' => ['required', 'string'],
            'urgent' => ['nullable', 'boolean'],
        ]);

        // Get user ID from session
        $userId = session('user')['id'] ?? null;

        // Prepare data for Supabase
        $announcementData = [
            'title' => $validated['title'],
            'category' => $validated['category'],
            'full_content' => $validated['content'],
            'urgent' => $request->has('urgent') && $request->urgent == '1',
        ];

        // Add posted_by if user ID is available and is a valid UUID
        // Note: If using session-based auth, user ID might not be a UUID
        // In that case, posted_by will be null (which is allowed in the schema)
        if ($userId && $this->isValidUuid($userId)) {
            $announcementData['posted_by'] = $userId;
        }

        try {
            // Save to Supabase
            $result = $this->supabase->insert('announcements', $announcementData);

            return redirect()->route('announcements.index')
                ->with('success', 'Announcement created successfully!');
        } catch (\Exception $e) {
            // Fallback to session storage if Supabase fails
            $summary = mb_substr(strip_tags($validated['content']), 0, 150);
            if (mb_strlen($validated['content']) > 150) {
                $summary .= '...';
            }

            $announcement = [
                'id' => time(),
                'title' => $validated['title'],
                'category' => $validated['category'],
                'date' => now()->format('M d, Y'),
                'summary' => $summary,
                'content' => $validated['content'],
                'urgent' => $request->has('urgent') && $request->urgent == '1',
                'images' => [],
            ];

            $announcements = session('announcements', []);
            array_unshift($announcements, $announcement);
            session(['announcements' => $announcements]);

            return redirect()->route('announcements.index')
                ->with('success', 'Announcement created successfully! (Saved locally)');
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
