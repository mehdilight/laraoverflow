<?php

namespace App\Actions\Reputation;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReputationActions
{
    public function increase(User $user, int $amount)
    {
        DB::statement(sprintf('UPDATE users SET reputation = reputation + %s WHERE id=%s', $amount, $user->id));

    }

    public function decrease(User $user, int $amount)
    {
        DB::statement(sprintf('UPDATE users SET reputation = reputation - %s WHERE id=%s', $amount, $user->id));
    }
}
