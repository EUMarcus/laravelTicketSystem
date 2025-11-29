<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnnouncementController extends Controller
{
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

        // Since this is a frontend-only app with hardcoded data,
        // we'll store the announcement in session for now
        // In a real app, you'd save this to a database
        
        // Auto-generate summary from content (first 150 characters)
        $summary = mb_substr(strip_tags($validated['content']), 0, 150);
        if (mb_strlen($validated['content']) > 150) {
            $summary .= '...';
        }
        
        $announcement = [
            'id' => time(), // Simple ID generation
            'title' => $validated['title'],
            'category' => $validated['category'],
            'date' => now()->format('M d, Y'),
            'summary' => $summary,
            'content' => $validated['content'],
            'urgent' => $request->has('urgent') && $request->urgent == '1',
            'images' => [], // No images
        ];

        // Store in session (in a real app, save to database)
        $announcements = session('announcements', []);
        array_unshift($announcements, $announcement); // Add to beginning
        session(['announcements' => $announcements]);

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement created successfully!');
    }
}

