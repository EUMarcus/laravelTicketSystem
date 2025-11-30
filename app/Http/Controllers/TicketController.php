<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Ticket;
use App\Services\SupabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if (!$profile) {
            $profile = Profile::create([
                'id' => $user->id,
                'role' => 'citizen',
                'name' => $user->name,
            ]);
        }

        if ($profile->isEmployee()) {
            $tickets = Ticket::with(['customer', 'assignedEmployee'])
                ->latest()
                ->paginate(15);
        } else {
            $tickets = Ticket::where('customer_id', $profile->id)
                ->with(['assignedEmployee'])
                ->latest()
                ->paginate(15);
        }

        if (request()->routeIs('staff.reports')) {
            return view('staff.reports', compact('tickets', 'profile'));
        }

        return view('reports.index', compact('tickets', 'profile'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'in:low,medium,high,urgent'],
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

        $ticket = Ticket::create([
            'id' => (string) Str::uuid(),
            'customer_id' => $profile->id,
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'status' => 'open',
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
                        $filePath = $file->storeAs("tickets/{$ticket->id}", $fileName, 'public');
                        
                        $ticket->attachments()->create([
                            'id' => (string) Str::uuid(),
                            'ticket_id' => $ticket->id,
                            'file_name' => $file->getClientOriginalName(),
                            'file_path' => $filePath,
                            'file_url' => asset('storage/' . $filePath),
                            'file_type' => $file->getMimeType(),
                            'file_size' => $file->getSize(),
                            'uploaded_by' => $profile->id,
                        ]);
                    } else {
                        $upload = $this->supabase->uploadFile($file, "tickets/{$ticket->id}");
                        
                        $ticket->attachments()->create([
                            'id' => (string) Str::uuid(),
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
                    Log::error('File upload failed: ' . $e->getMessage());
                    $uploadErrors[] = "File " . ($index + 1) . " (" . $file->getClientOriginalName() . "): " . $e->getMessage();
                }
            }
            
            if (!empty($uploadErrors)) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['attachments' => 'Some files failed to upload: ' . implode(', ', $uploadErrors)]);
            }
        }

        return redirect()->route('reports.show', $ticket->id)
            ->with('success', 'Report created successfully!');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['customer', 'assignedEmployee', 'messages.sender', 'messages.attachments', 'attachments']);
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

        return view('reports.show', compact('ticket', 'profile'));
    }

    public function edit(Ticket $ticket)
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if (!$profile || !$profile->isEmployee()) {
            abort(403, 'Only staff members can edit reports.');
        }

        return view('reports.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if ($profile && $profile->isEmployee()) {
            $validated = $request->validate([
                'subject' => ['sometimes', 'required', 'string', 'max:255'],
                'description' => ['sometimes', 'nullable', 'string'],
                'status' => ['sometimes', 'in:open,in_progress,resolved,closed'],
                'assigned_employee_id' => ['sometimes', 'exists:profiles,id'],
                'priority' => ['sometimes', 'in:low,medium,high,urgent'],
            ]);
        } else {
            $validated = $request->validate([
                'status' => ['sometimes', 'in:open,in_progress,resolved,closed'],
                'assigned_employee_id' => ['sometimes', 'exists:profiles,id'],
                'priority' => ['sometimes', 'in:low,medium,high,urgent'],
            ]);
        }

        if (isset($validated['status']) && $validated['status'] === 'resolved') {
            $validated['resolved_at'] = now();
        }

        $ticket->update($validated);

        return back()->with('success', 'Report updated successfully!');
    }

    public function destroy(Ticket $ticket)
    {
        $user = auth()->user();
        $profile = $user->profile;
        
        if (!$profile || !$profile->isEmployee()) {
            abort(403, 'Only staff members can delete reports.');
        }

        foreach ($ticket->attachments as $attachment) {
            try {
                if ($this->supabase->isConfigured() && $attachment->file_path) {
                    $this->supabase->deleteFile($attachment->file_path);
                } elseif ($attachment->file_path && file_exists(storage_path('app/public/' . $attachment->file_path))) {
                    unlink(storage_path('app/public/' . $attachment->file_path));
                }
            } catch (\Exception $e) {
                Log::error('Failed to delete attachment: ' . $e->getMessage());
            }
            $attachment->delete();
        }
        foreach ($ticket->messages as $message) {
            foreach ($message->attachments as $attachment) {
                try {
                    if ($this->supabase->isConfigured() && $attachment->file_path) {
                        $this->supabase->deleteFile($attachment->file_path);
                    } elseif ($attachment->file_path && file_exists(storage_path('app/public/' . $attachment->file_path))) {
                        unlink(storage_path('app/public/' . $attachment->file_path));
                    }
                } catch (\Exception $e) {
                    Log::error('Failed to delete message attachment: ' . $e->getMessage());
                }
                $attachment->delete();
            }
            $message->delete();
        }

        $ticket->delete();

        return redirect()->route('staff.reports')
            ->with('success', 'Report deleted successfully!');
    }
}

