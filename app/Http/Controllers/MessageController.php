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
            'attachments.*' => ['file', 'max:10240', 'mimes:jpeg,jpg,png,pdf,doc,docx'],
        ], [
            'attachments.*.file' => 'Each attachment must be a valid file.',
            'attachments.*.max' => 'Each attachment must not be larger than 10MB.',
            'attachments.*.mimes' => 'Attachments must be one of: JPEG, JPG, PNG, PDF, DOC, DOCX.',
        ]);

        $user = auth()->user();
        $profile = $user->profile;
        
        if (!$profile) {
            $profile = Profile::create([
                'id' => $user->id,
                'role' => 'citizen',
                'name' => $user->name,
            ]);
        }

        if ($profile->isCitizen() && $ticket->customer_id !== $profile->id) {
            abort(403);
        }

        $message = Message::create([
            'id' => (string) Str::uuid(),
            'ticket_id' => $ticket->id,
            'sender_id' => $profile->id,
            'content' => $validated['content'] ?? '',
        ]);

        // for file uploads
        if ($request->hasFile('attachments')) {
            $uploadErrors = [];
            
            foreach ($request->file('attachments') as $index => $file) {
                try {
                    if (!$file->isValid()) {
                        $uploadErrors[] = "File " . ($index + 1) . ": " . $file->getErrorMessage();
                        continue;
                    }

                    if (!$this->supabase->isConfigured()) {
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
            
            if (!empty($uploadErrors)) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['attachments' => 'Some files failed to upload: ' . implode(', ', $uploadErrors)]);
            }
        }

        if ($ticket->status === 'resolved' || $ticket->status === 'closed') {
            $ticket->update(['status' => 'in_progress']);
        }

        return back();
    }
}

