<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'category',
        'full_content',
        'urgent',
        'posted_by',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'id' => 'string',
        'posted_by' => 'string',
        'urgent' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'posted_by');
    }
}
