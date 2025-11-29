<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Event extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'category',
        'image_url',
    ];

    protected $casts = [
        'id' => 'string',
        'event_date' => 'date',
        'event_time' => 'datetime',
    ];
}
