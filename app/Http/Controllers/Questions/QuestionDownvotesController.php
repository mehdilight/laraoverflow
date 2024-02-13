<?php

namespace App\Http\Controllers\Questions;

use App\Actions\Reputation\ReputationActions;
use App\BusinessServices\Voting\VotingService;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class QuestionDownvotesController extends Controller
{
    public function __construct(
        private VotingService $votingService,
        private ReputationActions $reputationActions
    )
    {
    }

    public function store(Question $question)
    {
        /** @var User $user */
        $user = Auth::user();
        abort_unless($user->id !== $question->user_id, Response::HTTP_UNAUTHORIZED);

        $this->votingService->downvote($question, $user);

        /** @var User $answerAuthor */
        $questionAuthor = $question->user;
        $this->reputationActions->decrease($questionAuthor, 2);

        return redirect()
            ->back();
    }
}
