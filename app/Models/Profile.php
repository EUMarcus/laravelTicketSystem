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

    public function isEmployee()
    {
        return in_array($this->role, ['employee', 'admin']);
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function isCitizen()
    {
        return $this->role === 'citizen' || $this->role === 'customer';
    }
}


