<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Announcement extends Model
{
    use HasUuids;

    protected $fillable = [
        'posted_by',
        'title',
        'content',
        'category',
        'image_url',
    ];

    protected $casts = [
        'id' => 'string',
        'posted_by' => 'string',
    ];

    public function postedBy()
    {
        return $this->belongsTo(Profile::class, 'posted_by');
    }
}
