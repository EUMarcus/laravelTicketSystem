<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuggestionComment extends Model
{
    use HasUuids;

    protected $fillable = [
        'suggestion_id',
        'comment_from',
        'comment',
    ];

    protected $casts = [
        'id' => 'string',
        'suggestion_id' => 'string',
        'comment_from' => 'string',
    ];

    public function suggestion(): BelongsTo
    {
        return $this->belongsTo(Suggestion::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'comment_from');
    }
}
