<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Profile;
use App\Models\Ticket;
use App\Services\SupabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:10240', 'mimes:jpeg,jpg,png,pdf,doc,docx'], // 10MB max
        ], [
            'attachments.*.file' => 'Each attachment must be a valid file.',
            'attachments.*.max' => 'Each attachment must not be larger than 10MB.',
            'attachments.*.mimes' => 'Attachments must be one of: JPEG, JPG, PNG, PDF, DOC, DOCX.',
        ]);

        $user = auth()->user();
        // With FK constraint, profile must exist for every user
        $profile = $user->profile;
        
        // Legacy data migration: create profile if missing (shouldn't happen with FK)
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
            $uploadErrors = [];
            
            foreach ($request->file('attachments') as $index => $file) {
                try {
                    // Validate file before upload
                    if (!$file->isValid()) {
                        $uploadErrors[] = "File " . ($index + 1) . ": " . $file->getErrorMessage();
                        continue;
                    }

                    // Check if Supabase is configured
                    if (!$this->supabase->isConfigured()) {
                        // Fallback: Store file locally if Supabase is not configured
                        $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                        $filePath = $file->storeAs("tickets/{$ticket->id}/messages", $fileName, 'public');
                        
                        $message->attachments()->create([
                            'id' => (string) Str::uuid(),
                            'message_id' => $message->id,
                            'ticket_id' => $ticket->id,
                            'file_name' => $file->getClientOriginalName(),
                            'file_path' => $filePath,
                            'file_url' => asset('storage/' . $filePath),
                            'file_type' => $file->getMimeType(),
                            'file_size' => $file->getSize(),
                            'uploaded_by' => $profile->id,
                        ]);
                    } else {
                        // Upload to Supabase
                        $upload = $this->supabase->uploadFile($file, "tickets/{$ticket->id}/messages");
                        
                        $message->attachments()->create([
                            'id' => (string) Str::uuid(),
                            'message_id' => $message->id,
                            'ticket_id' => $ticket->id,
                            'file_name' => $file->getClientOriginalName(),
                            'file_path' => $upload['path'],
                            'file_url' => $upload['url'],
                            'file_type' => $file->getMimeType(),
                            'file_size' => $file->getSize(),
                            'uploaded_by' => $profile->id,
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error('Message file upload failed: ' . $e->getMessage());
                    $uploadErrors[] = "File " . ($index + 1) . " (" . $file->getClientOriginalName() . "): " . $e->getMessage();
                }
            }
            
            // If there were upload errors, redirect back with errors
            if (!empty($uploadErrors)) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['attachments' => 'Some files failed to upload: ' . implode(', ', $uploadErrors)]);
            }
        }

        // Update ticket status if needed
        if ($ticket->status === 'resolved' || $ticket->status === 'closed') {
            $ticket->update(['status' => 'in_progress']);
        }

        return back();
    }
}

