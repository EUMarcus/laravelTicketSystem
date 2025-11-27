<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Ticket extends Model
{
    use HasUuids;

    protected $fillable = [
        'customer_id',
        'assigned_employee_id',
        'subject',
        'description',
        'status',
        'priority',
        'resolved_at',
    ];

    protected $casts = [
        'id' => 'string',
        'customer_id' => 'string',
        'assigned_employee_id' => 'string',
        'resolved_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Profile::class, 'customer_id');
    }

    public function assignedEmployee()
    {
        return $this->belongsTo(Profile::class, 'assigned_employee_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'open' => 'kampay-teal',
            'in_progress' => 'kampay-yellow-orange',
            'resolved' => 'kampay-blue',
            'closed' => 'gray-500',
            default => 'gray-400',
        };
    }

    public function getPriorityColorAttribute()
    {
        return match($this->priority) {
            'low' => 'gray-400',
            'medium' => 'kampay-blue',
            'high' => 'kampay-yellow-orange',
            'urgent' => 'kampay-red',
            default => 'gray-400',
        };
    }
}


