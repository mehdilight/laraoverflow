<?php

namespace App\Http\Controllers\Questions\Answers;

use App\BusinessServices\Voting\VotingService;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AnswerDownvotesController extends Controller
{
    public function __construct(private VotingService $votingService)
    {
    }

    public function store(Question $question, Answer $answer)
    {
        /** @var User $user */
        $user = Auth::user();

        $this->votingService->downvote($answer, $user);

        return redirect()
            ->back()
            ->with('success', 'answer successfully downvote');
    }
}
