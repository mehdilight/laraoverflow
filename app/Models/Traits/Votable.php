<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Votable
{
    public function votes(): MorphMany
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function userVote(User $user): ?Vote
    {
        return $this->votes->where('user_id', $user->id)->first();
    }
}
