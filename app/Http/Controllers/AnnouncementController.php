<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AnnouncementController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        try {
            // Fetch announcements from Supabase, ordered by created_at descending
            $announcements = $this->supabase->select('announcements', [], 'announce_id,title,category,full_content,urgent,created_at,posted_by', 'created_at', 'desc');

            // Transform data to match view expectations
            $formattedAnnouncements = array_map(function ($announcement) {
                // Generate summary from full_content
                $summary = mb_substr(strip_tags($announcement['full_content'] ?? ''), 0, 150);
                if (mb_strlen($announcement['full_content'] ?? '') > 150) {
                    $summary .= '...';
                }

                // Format date
                $date = isset($announcement['created_at'])
                    ? \Carbon\Carbon::parse($announcement['created_at'])->format('M d, Y')
                    : now()->format('M d, Y');

                return [
                    'id' => $announcement['announce_id'],
                    'title' => $announcement['title'],
                    'category' => $announcement['category'] ?? 'Other',
                    'date' => $date,
                    'summary' => $summary,
                    'content' => $announcement['full_content'],
                    'urgent' => $announcement['urgent'] ?? false,
                    'images' => [], // No images for now
                ];
            }, $announcements);

            // Merge with session announcements (if any)
            $sessionAnnouncements = session('announcements', []);
            $allAnnouncements = array_merge($sessionAnnouncements, $formattedAnnouncements);

            // Sort by date (newest first)
            usort($allAnnouncements, function ($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });

            // Paginate
            $perPage = 6;
            $currentPage = request('page', 1);
            $total = count($allAnnouncements);
            $offset = ($currentPage - 1) * $perPage;
            $paginatedAnnouncements = array_slice($allAnnouncements, $offset, $perPage);

            $announcements = new \Illuminate\Pagination\LengthAwarePaginator(
                $paginatedAnnouncements,
                $total,
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            // Determine which view to use based on route
            $view = request()->routeIs('staff.announcements') ? 'staff.announcements' : 'announcements.index';
            return view($view, compact('announcements'));
        } catch (\Exception $e) {
            // Fallback to hardcoded data if Supabase fails
            $hardcodedAnnouncements = [
                ['id' => 1, 'title' => 'Community Clean-Up Day Scheduled', 'category' => 'Event', 'date' => 'Dec 5, 2024', 'summary' => 'Join us for a community-wide clean-up activity this coming Saturday. All residents are welcome to participate.', 'urgent' => false],
                ['id' => 2, 'title' => 'Health Advisory: Dengue Prevention', 'category' => 'Health', 'date' => 'Dec 3, 2024', 'summary' => 'Important reminders on preventing dengue. Keep your surroundings clean and eliminate stagnant water.', 'urgent' => true],
                ['id' => 3, 'title' => 'Barangay Meeting This Saturday', 'category' => 'Meeting', 'date' => 'Dec 1, 2024', 'summary' => 'Monthly barangay meeting scheduled. All residents are encouraged to attend and voice their concerns.', 'urgent' => false],
            ];

            $sessionAnnouncements = session('announcements', []);
            $allAnnouncements = array_merge($sessionAnnouncements, $hardcodedAnnouncements);

            $perPage = 6;
            $currentPage = request('page', 1);
            $total = count($allAnnouncements);
            $offset = ($currentPage - 1) * $perPage;
            $paginatedAnnouncements = array_slice($allAnnouncements, $offset, $perPage);

            $announcements = new \Illuminate\Pagination\LengthAwarePaginator(
                $paginatedAnnouncements,
                $total,
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            // Determine which view to use based on route
            $view = request()->routeIs('staff.announcements') ? 'staff.announcements' : 'announcements.index';
            return view($view, compact('announcements'));
        }
    }

    public function show($id)
    {
        try {
            // Fetch announcement from Supabase
            $announcements = $this->supabase->select('announcements', ['announce_id' => $id], 'announce_id,title,category,full_content,urgent,created_at,posted_by');

            if (empty($announcements)) {
                abort(404, 'Announcement not found');
            }

            $announcement = $announcements[0];

            // Format date
            $date = isset($announcement['created_at'])
                ? \Carbon\Carbon::parse($announcement['created_at'])->format('M d, Y')
                : now()->format('M d, Y');

            // Transform to match view expectations
            $formattedAnnouncement = [
                'id' => $announcement['announce_id'],
                'title' => $announcement['title'],
                'category' => $announcement['category'] ?? 'Other',
                'date' => $date,
                'summary' => mb_substr(strip_tags($announcement['full_content'] ?? ''), 0, 150) . '...',
                'content' => $announcement['full_content'],
                'urgent' => $announcement['urgent'] ?? false,
                'images' => [], // No images for now
            ];

            return view('announcements.show', ['announcement' => $formattedAnnouncement]);
        } catch (\Exception $e) {
            // Fallback to hardcoded data
            $hardcodedAnnouncements = [
                ['id' => 1, 'title' => 'Community Clean-Up Day Scheduled', 'category' => 'Event', 'date' => 'Dec 5, 2024', 'summary' => 'Join us for a community-wide clean-up activity this coming Saturday. All residents are welcome to participate.', 'urgent' => false, 'content' => 'We are excited to announce our upcoming Community Clean-Up Day scheduled for Saturday, December 14, 2024, from 8:00 AM to 12:00 PM. This is a community-wide initiative to clean and beautify our barangay. All residents are warmly invited to participate in this activity. Together, we can make our community a cleaner and more beautiful place to live.', 'images' => []],
            ];

            $announcement = collect($hardcodedAnnouncements)->firstWhere('id', (int)$id);

            if (!$announcement) {
                abort(404, 'Announcement not found');
            }

            return view('announcements.show', ['announcement' => $announcement]);
        }
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
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
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

        // Add start_date if provided (convert from datetime-local format to ISO 8601 with timezone)
        if (!empty($validated['start_date'])) {
            $announcementData['start_date'] = Carbon::parse($validated['start_date'])->setTimezone('UTC')->toIso8601String();
        }

        // Add end_date if provided (convert from datetime-local format to ISO 8601 with timezone)
        if (!empty($validated['end_date'])) {
            $announcementData['end_date'] = Carbon::parse($validated['end_date'])->setTimezone('UTC')->toIso8601String();
        }

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
