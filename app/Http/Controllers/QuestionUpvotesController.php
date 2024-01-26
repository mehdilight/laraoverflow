<?php

namespace App\Http\Controllers;

use App\BusinessServices\Voting\VotingService;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class QuestionUpvotesController extends Controller
{
    public function __construct(private VotingService $votingService)
    {
    }

    public function store(Question $question)
    {
        /** @var User $user */
        $user = Auth::user();

        $this->votingService->upvote($question, $user);

        return redirect()
            ->back();
    }
}
