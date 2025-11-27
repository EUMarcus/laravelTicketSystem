<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Message extends Model
{
    use HasUuids;

    protected $fillable = [
        'ticket_id',
        'sender_id',
        'content',
    ];

    protected $casts = [
        'id' => 'string',
        'ticket_id' => 'string',
        'sender_id' => 'string',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function sender()
    {
        return $this->belongsTo(Profile::class, 'sender_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}


