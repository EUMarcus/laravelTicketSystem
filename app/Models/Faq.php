<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Faq extends Model
{
    use HasUuids;

    protected $fillable = [
        'category',
        'question',
        'answer',
        'order',
    ];

    protected $casts = [
        'id' => 'string',
        'order' => 'integer',
    ];
}
