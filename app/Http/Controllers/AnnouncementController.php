<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AnnouncementController extends Controller
{
    public function index()
    {
        try {
            $announcements = Announcement::with('author')
                ->latest()
                ->get()
                ->map(function ($announcement) {
                    $summary = mb_substr(strip_tags($announcement->full_content ?? ''), 0, 150);
                    if (mb_strlen($announcement->full_content ?? '') > 150) {
                        $summary .= '...';
                    }

                    return [
                        'id' => $announcement->id,
                        'title' => $announcement->title,
                        'category' => $announcement->category ?? 'Other',
                        'date' => $announcement->created_at->format('M d, Y'),
                        'summary' => $summary,
                        'content' => $announcement->full_content,
                        'urgent' => $announcement->urgent ?? false,
                        'images' => [],
                    ];
                });

            $sessionAnnouncements = session('announcements', []);
            $allAnnouncements = $announcements->merge($sessionAnnouncements)->all();

            usort($allAnnouncements, function ($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });
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

            $view = request()->routeIs('staff.announcements') ? 'staff.announcements' : 'announcements.index';
            return view($view, compact('announcements'));
        } catch (\Exception $e) {
            \Log::error('Failed to fetch announcements: ' . $e->getMessage());
            
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

            $view = request()->routeIs('staff.announcements') ? 'staff.announcements' : 'announcements.index';
            return view($view, compact('announcements'));
        }
    }

    public function show($id)
    {
        try {
            $announcement = Announcement::with('author')->findOrFail($id);

            $date = $announcement->created_at->format('M d, Y');

            $startDate = null;
            if ($announcement->start_date) {
                $startDate = $announcement->start_date->format('M d, Y g:i A');
            }

            $endDate = null;
            if ($announcement->end_date) {
                $endDate = $announcement->end_date->format('M d, Y g:i A');
            }

            $formattedAnnouncement = [
                'id' => $announcement->id,
                'title' => $announcement->title,
                'category' => $announcement->category ?? 'Other',
                'date' => $date,
                'summary' => mb_substr(strip_tags($announcement->full_content ?? ''), 0, 150) . '...',
                'content' => $announcement->full_content,
                'urgent' => $announcement->urgent ?? false,
                'images' => [],
                'start_date' => $startDate,
                'end_date' => $endDate,
            ];

            return view('announcements.show', ['announcement' => $formattedAnnouncement]);
        } catch (\Exception $e) {
            \Log::error('Failed to fetch announcement: ' . $e->getMessage());
            
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

        $userId = session('user')['id'] ?? null;

        try {
            $announcement = Announcement::create([
                'id' => (string) Str::uuid(),
                'title' => $validated['title'],
                'category' => $validated['category'],
                'full_content' => $validated['content'],
                'urgent' => $request->has('urgent') && $request->urgent == '1',
                'posted_by' => $userId,
                'start_date' => !empty($validated['start_date']) ? Carbon::parse($validated['start_date']) : null,
                'end_date' => !empty($validated['end_date']) ? Carbon::parse($validated['end_date']) : null,
            ]);

            return redirect()->route('announcements.index')
                ->with('success', 'Announcement created successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to create announcement: ' . $e->getMessage());
            
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

    public function edit($id)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can edit announcements.');
        }

        try {
            $announcement = Announcement::findOrFail($id);
            
            $startDate = null;
            if ($announcement->start_date) {
                $startDate = $announcement->start_date->format('Y-m-d\TH:i');
            }
            
            $endDate = null;
            if ($announcement->end_date) {
                $endDate = $announcement->end_date->format('Y-m-d\TH:i');
            }
            
            return view('announcements.edit', [
                'announcement' => [
                    'id' => $announcement->id,
                    'title' => $announcement->title,
                    'category' => $announcement->category ?? 'Other',
                    'content' => $announcement->full_content,
                    'urgent' => $announcement->urgent ?? false,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to fetch announcement for edit: ' . $e->getMessage());
            abort(404, 'Announcement not found');
        }
    }

    public function update(Request $request, $id)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can edit announcements.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:Event,Health,Meeting,Service,Infrastructure,Safety,Education,Other'],
            'content' => ['required', 'string'],
            'urgent' => ['nullable', 'boolean'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        try {
            $announcement = Announcement::findOrFail($id);
            
            $announcement->update([
                'title' => $validated['title'],
                'category' => $validated['category'],
                'full_content' => $validated['content'],
                'urgent' => $request->has('urgent') && $request->urgent == '1',
                'start_date' => !empty($validated['start_date']) ? Carbon::parse($validated['start_date']) : null,
                'end_date' => !empty($validated['end_date']) ? Carbon::parse($validated['end_date']) : null,
            ]);

            return redirect()->route('announcements.show', $id)
                ->with('success', 'Announcement updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to update announcement: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Failed to update announcement. Please try again.']);
        }
    }

    public function destroy($id)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can delete announcements.');
        }

        try {
            $announcement = Announcement::findOrFail($id);
            $announcement->delete();

            return redirect()->route('staff.announcements')
                ->with('success', 'Announcement deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to delete announcement: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['message' => 'Failed to delete announcement. Please try again.']);
        }
    }
}
