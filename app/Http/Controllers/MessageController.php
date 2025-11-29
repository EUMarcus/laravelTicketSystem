<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Profile;
use App\Models\Ticket;
use App\Services\SupabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function store(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'content' => ['nullable', 'string', 'required_without:attachments'],
            'attachments.*' => ['file', 'max:10240'], // 10MB max
        ]);

        $user = auth()->user();
        $profile = Profile::find($user->id) ?? Profile::where('name', $user->name)->first();

        if (!$profile) {
            $profile = Profile::create([
                'id' => $user->id,
                'role' => 'citizen',
                'name' => $user->name,
            ]);
        }

        // Check access
        if ($profile->isCitizen() && $ticket->customer_id !== $profile->id) {
            abort(403);
        }

        $message = Message::create([
            'id' => (string) Str::uuid(),
            'ticket_id' => $ticket->id,
            'sender_id' => $profile->id,
            'content' => $validated['content'] ?? '',
        ]);

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $upload = $this->supabase->uploadFile($file, "tickets/{$ticket->id}/messages");
                
                $message->attachments()->create([
                    'id' => (string) Str::uuid(),
                    'message_id' => $message->id,
                    'ticket_id' => $ticket->id,
                    'file_name' => $upload['name'],
                    'file_path' => $upload['path'],
                    'file_url' => $upload['url'],
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'uploaded_by' => $profile->id,
                ]);
            }
        }

        // Update ticket status if needed
        if ($ticket->status === 'resolved' || $ticket->status === 'closed') {
            $ticket->update(['status' => 'in_progress']);
        }

        return back()->with('success', 'Message sent!');
    }
}

