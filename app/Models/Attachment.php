<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Attachment extends Model
{
    use HasUuids;

    protected $fillable = [
        'message_id',
        'ticket_id',
        'file_name',
        'file_path',
        'file_url',
        'file_type',
        'file_size',
        'uploaded_by',
    ];

    protected $casts = [
        'id' => 'string',
        'message_id' => 'string',
        'ticket_id' => 'string',
        'uploaded_by' => 'string',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function uploader()
    {
        return $this->belongsTo(Profile::class, 'uploaded_by');
    }

    public function isImage()
    {
        return str_starts_with($this->file_type ?? '', 'image/');
    }
}


