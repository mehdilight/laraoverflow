<?php

namespace App\BusinessServices\Voting;

use App\Actions\Reputation\ReputationActions;
use App\Models\Answer;
use App\Models\Traits\Votable;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class VotingService
{
    public function __construct(private ReputationActions $reputationActions)
    {
    }

    public function upvote(Votable|Model $votable, User $user): Vote
    {
        $this->assertModelUsingCommentableTrait($votable);
        $this->assertNotUpVoted($votable, $user);

        $vote = $votable->votes()->where('user_id', $user->id)->first();
        if (!$vote instanceof Vote) {
            return $this->createNewVote($votable, $user, Vote::UPVOTE_TYPE);
        }

        $this->rollbackToPreviousState($vote, $votable);

        return $this->createNewVote($votable, $user, Vote::UPVOTE_TYPE);
    }

    public function downvote(Votable|Model $votable, User $user): Vote
    {
        $this->assertModelUsingCommentableTrait($votable);
        $this->assertNotDownVoted($votable, $user);

        $vote = $votable->votes()->where('user_id', $user->id)->first();
        if (!$vote instanceof Vote) {
            return $this->createNewVote($votable, $user, Vote::DOWN_UPVOTE_TYPE);
        }

        $this->rollbackToPreviousState($vote, $votable);

        return $this->createNewVote($votable, $user, Vote::DOWN_UPVOTE_TYPE);
    }

    /**
     * @param Votable|Model $votable
     */
    private function assertModelUsingCommentableTrait(Votable|Model $votable): void
    {
        if (in_array(Votable::class, class_uses_recursive($votable))) {
            return;
        }

        throw new InvalidArgumentException(sprintf("%s should use commentable trait", $votable::class));
    }

    private function createNewVote(Model|Votable $votable, User $user, int $voteValue): Vote
    {
        $vote = $votable->votes()->create(
            [
                'user_id' => $user->id,
                'value'   => $voteValue
            ]
        );

        // update the votable's votes_score column with updating `updated_at` column
        DB::statement(sprintf('UPDATE %s SET votes_score = votes_score + %s WHERE id=%s', $votable->getTable(), $voteValue, $votable->id));

        return $vote;
    }

    private function rollbackToPreviousState(Vote $vote, Model|Votable $votable): void
    {
        // update the votable's votes_score column without updating `updated_at` column
        DB::statement(sprintf('UPDATE %s SET votes_score = votes_score - %s WHERE id=%s', $votable->getTable(), $vote->value, $votable->id));

        $votableOwner = $votable->user;
        $this->reputationActions->decrease($votableOwner, $vote->value === Vote::UPVOTE_TYPE ? 10 : -2);

        if ($votable instanceof Answer && $vote->value === Vote::DOWN_UPVOTE_TYPE) {
            $this->reputationActions->decrease(Auth::user(), -1);
        }

        $vote->delete();
    }

    private function assertNotUpVoted(Model|Votable $votable, User $user)
    {
        if ($votable->votes()->where('user_id', $user->id)->first()?->value !== Vote::UPVOTE_TYPE) {
            return;
        }

        throw new InvalidArgumentException('user already voted');
    }

    private function assertNotDownVoted(Model|Votable $votable, User $user)
    {
        if ($votable->votes()->where('user_id', $user->id)->first()?->value !== Vote::DOWN_UPVOTE_TYPE) {
            return;
        }

        throw new InvalidArgumentException('user already voted');
    }
}
