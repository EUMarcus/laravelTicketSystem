<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Profile extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'role',
        'name',
        'address',
        'contact_number',
        'email',
        'is_verified',
        'avatar_url',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'customer_id');
    }

    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_employee_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function suggestions()
    {
        return $this->hasMany(Suggestion::class, 'resident_id');
    }

    public function suggestionUpvotes()
    {
        return $this->hasMany(SuggestionUpvote::class, 'resident_id');
    }

    public function pollVotes()
    {
        return $this->hasMany(PollVote::class, 'resident_id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'posted_by');
    }

    public function polls()
    {
        return $this->hasMany(Poll::class, 'created_by');
    }

    public function isEmployee()
    {
        return in_array($this->role, ['staff', 'admin']);
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function isResident()
    {
        return $this->role === 'resident';
    }

    public function isStaff()
    {
        return in_array($this->role, ['staff', 'admin']);
    }
}


