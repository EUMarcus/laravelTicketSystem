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

        $ticket = Ticket::create([
            'id' => (string) Str::uuid(),
            'customer_id' => $profile->id,
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'status' => 'open',
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
                        // Upload to Supabase
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
            
            // If there were upload errors, redirect back with errors
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

        return view('reports.show', compact('ticket', 'profile'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => ['sometimes', 'in:open,in_progress,resolved,closed'],
            'assigned_employee_id' => ['sometimes', 'exists:profiles,id'],
            'priority' => ['sometimes', 'in:low,medium,high,urgent'],
        ]);

        if (isset($validated['status']) && $validated['status'] === 'resolved') {
            $validated['resolved_at'] = now();
        }

        $ticket->update($validated);

        return back()->with('success', 'Report updated successfully!');
    }
}

