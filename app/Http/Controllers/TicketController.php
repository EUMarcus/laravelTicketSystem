<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Ticket;
use App\Services\SupabaseService;
use Illuminate\Http\Request;
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
        $profile = Profile::find($user->id) ?? Profile::where('name', $user->name)->first();

        if (!$profile) {
            // Create profile if it doesn't exist (for existing users)
            $profile = Profile::create([
                'id' => $user->id,
                'role' => 'customer',
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

        return view('tickets.index', compact('tickets', 'profile'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'in:low,medium,high,urgent'],
            'attachments.*' => ['file', 'max:10240'], // 10MB max
        ]);

        $user = auth()->user();
        $profile = Profile::find($user->id) ?? Profile::where('name', $user->name)->first();

        if (!$profile) {
            $profile = Profile::create([
                'id' => $user->id,
                'role' => 'customer',
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
            foreach ($request->file('attachments') as $file) {
                $upload = $this->supabase->uploadFile($file, "tickets/{$ticket->id}");
                
                $ticket->attachments()->create([
                    'id' => (string) Str::uuid(),
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

        return redirect()->route('tickets.show', $ticket->id)
            ->with('success', 'Ticket created successfully!');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['customer', 'assignedEmployee', 'messages.sender', 'messages.attachments', 'attachments']);
        $user = auth()->user();
        $profile = Profile::find($user->id) ?? Profile::where('name', $user->name)->first();

        if (!$profile) {
            $profile = Profile::create([
                'id' => $user->id,
                'role' => 'customer',
                'name' => $user->name,
            ]);
        }

        // Check access
        if ($profile->isCustomer() && $ticket->customer_id !== $profile->id) {
            abort(403);
        }

        return view('tickets.show', compact('ticket', 'profile'));
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

        return back()->with('success', 'Ticket updated successfully!');
    }
}

