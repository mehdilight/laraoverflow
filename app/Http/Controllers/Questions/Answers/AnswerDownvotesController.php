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

class AnswerDownvotesController extends Controller
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

        $this->votingService->downvote($answer, $user);

        /** @var User $answerAuthor */
        $answerAuthor = $answer->user;
        $this->reputationActions->decrease($answerAuthor, 2);
        $this->reputationActions->decrease($user, 1);

        return redirect()
            ->back()
            ->with('success', 'answer successfully downvote');
    }
}
