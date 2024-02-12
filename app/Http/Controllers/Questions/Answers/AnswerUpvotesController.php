<?php

namespace App\Http\Controllers\Questions\Answers;

use App\Actions\Reputation\ReputationActions;
use App\BusinessServices\Voting\VotingService;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AnswerUpvotesController extends Controller
{
    public function __construct(
        private VotingService $votingService,
        private ReputationActions $reputationActions
    )
    {
    }

    public function store(Question $question, Answer $answer)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->id !== $answer->user_id, Response::HTTP_UNAUTHORIZED);

        $this->votingService->upvote($answer, $user);

        /** @var User $answerAuthor */
        $answerAuthor = $answer->user;
        $this->reputationActions->increase($answerAuthor, 10);

        return redirect()
            ->back()
            ->with('success', 'answer successfully upvote');
    }
}
