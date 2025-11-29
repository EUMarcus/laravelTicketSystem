<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Suggestion extends Model
{
    use HasUuids;

    protected $fillable = [
        'resident_id',
        'title',
        'description',
        'category',
        'is_anonymous',
        'upvotes_count',
        'comments_count',
    ];

    protected $casts = [
        'id' => 'string',
        'resident_id' => 'string',
        'is_anonymous' => 'boolean',
        'upvotes_count' => 'integer',
        'comments_count' => 'integer',
    ];

    public function resident()
    {
        return $this->belongsTo(Profile::class, 'resident_id');
    }

    public function upvotes()
    {
        return $this->hasMany(SuggestionUpvote::class);
    }

    public function hasUpvoted($residentId)
    {
        return $this->upvotes()->where('resident_id', $residentId)->exists();
    }
}
