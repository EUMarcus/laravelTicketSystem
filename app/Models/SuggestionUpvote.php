<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SuggestionUpvote extends Model
{
    use HasUuids;

    protected $fillable = [
        'suggestion_id',
        'resident_id',
    ];

    protected $casts = [
        'id' => 'string',
        'suggestion_id' => 'string',
        'resident_id' => 'string',
    ];

    public function suggestion()
    {
        return $this->belongsTo(Suggestion::class);
    }

    public function resident()
    {
        return $this->belongsTo(Profile::class, 'resident_id');
    }
}
