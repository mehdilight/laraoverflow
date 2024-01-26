<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait Votable
{
    public function votes(): MorphMany
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    protected function userVote(): Attribute
    {
        /** @var User $user */
        $user = Auth::user();

        return Attribute::make(function () use ($user) {
            if (!$user instanceof User) return null;
            return $this->votes()->where('user_id', $user->id)->first();
        });
    }
}
