<?php

namespace App\BusinessServices\Voting;

use App\Models\Traits\Votable;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class VotingService
{
    public function upvote(Votable|Model $votable, User $user): Vote
    {
        $this->assertModelUsingCommentableTrait($votable);

        $vote = $votable->votes()->where('user_id', $user->id)->first();
        if (!$vote instanceof Vote) {
            return $this->createNewVote($votable, $user, Vote::UPVOTE_TYPE);
        }

        if ($vote->value === Vote::UPVOTE_TYPE) {
            return $vote;
        }

        $this->decrementVotesScoreThenDestroyVoteModel($vote, $votable);

        return $this->createNewVote($votable, $user, Vote::UPVOTE_TYPE);
    }

    public function downvote(Votable|Model $votable, User $user): Vote
    {
        $this->assertModelUsingCommentableTrait($votable);

        $vote = $votable->votes()->where('user_id', $user->id)->first();
        if (!$vote instanceof Vote) {
            return $this->createNewVote($votable, $user, Vote::DOWN_UPVOTE_TYPE);
        }

        if ($vote->value === Vote::DOWN_UPVOTE_TYPE) {
            return $vote;
        }

        $this->decrementVotesScoreThenDestroyVoteModel($vote, $votable);

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

    private function decrementVotesScoreThenDestroyVoteModel(Vote $vote, Model|Votable $votable): void
    {
        // update the votable's votes_score column with updating `updated_at` column
        DB::statement(sprintf('UPDATE %s SET votes_score = votes_score - %s WHERE id=%s', $votable->getTable(), $vote->value, $votable->id));

        $vote->delete();
    }
}
