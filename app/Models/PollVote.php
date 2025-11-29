<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PollVote extends Model
{
    use HasUuids;

    protected $fillable = [
        'poll_id',
        'resident_id',
        'selected_option',
    ];

    protected $casts = [
        'id' => 'string',
        'poll_id' => 'string',
        'resident_id' => 'string',
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function resident()
    {
        return $this->belongsTo(Profile::class, 'resident_id');
    }
}
