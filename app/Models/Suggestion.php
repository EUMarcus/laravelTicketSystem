<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Suggestion extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'category',
        'full_content',
        'status',
        'posted_by',
    ];

    protected $casts = [
        'id' => 'string',
        'posted_by' => 'string',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'posted_by');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(SuggestionComment::class);
    }
}
