<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
            'summary' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'urgent' => ['nullable', 'boolean'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:5120'], // 5MB max per image
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store in public/announcements directory
                $path = $image->store('announcements', 'public');
                $imagePaths[] = Storage::url($path);
            }
        }

        // Since this is a frontend-only app with hardcoded data,
        // we'll store the announcement in session for now
        // In a real app, you'd save this to a database
        
        $announcement = [
            'id' => time(), // Simple ID generation
            'title' => $validated['title'],
            'category' => $validated['category'],
            'date' => now()->format('M d, Y'),
            'summary' => $validated['summary'],
            'content' => $validated['content'],
            'urgent' => $request->has('urgent') && $request->urgent == '1',
            'images' => $imagePaths, // Store image paths
        ];

        // Store in session (in a real app, save to database)
        $announcements = session('announcements', []);
        array_unshift($announcements, $announcement); // Add to beginning
        session(['announcements' => $announcements]);

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement created successfully!');
    }
}

