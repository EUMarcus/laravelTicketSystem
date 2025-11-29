<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Poll extends Model
{
    use HasUuids;

    protected $fillable = [
        'created_by',
        'question',
        'description',
        'options',
        'deadline',
        'is_active',
    ];

    protected $casts = [
        'id' => 'string',
        'created_by' => 'string',
        'options' => 'array',
        'deadline' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function createdBy()
    {
        return $this->belongsTo(Profile::class, 'created_by');
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    public function hasVoted($residentId)
    {
        return $this->votes()->where('resident_id', $residentId)->exists();
    }

    public function getResultsAttribute()
    {
        $totalVotes = $this->votes()->count();
        if ($totalVotes === 0) {
            return [];
        }

        $results = [];
        foreach ($this->options as $option) {
            $votes = $this->votes()->where('selected_option', $option)->count();
            $results[] = [
                'option' => $option,
                'votes' => $votes,
                'percentage' => round(($votes / $totalVotes) * 100, 1),
            ];
        }

        return $results;
    }
}
