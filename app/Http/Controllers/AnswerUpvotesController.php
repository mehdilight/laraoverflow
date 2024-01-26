<?php

namespace App\Http\Controllers;

use App\BusinessServices\Voting\VotingService;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AnswerUpvotesController extends Controller
{
    public function __construct(private VotingService $votingService)
    {
    }

    public function store(Question $question, Answer $answer)
    {
        /** @var User $user */
        $user = Auth::user();

        $this->votingService->upvote($answer, $user);

        return redirect()
            ->back();
    }
}
