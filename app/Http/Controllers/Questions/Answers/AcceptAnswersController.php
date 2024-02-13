<?php

namespace App\Http\Controllers\Questions\Answers;

use App\Actions\Reputation\ReputationActions;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AcceptAnswersController extends Controller
{
    public function __construct(private ReputationActions $reputationActions)
    {
    }

    public function store(Question $question, string $answerId)
    {
        $user = Auth::user();
        abort_unless($question->user_id === $user->id, Response::HTTP_UNAUTHORIZED);

        $existingAcceptedAsnwer = $question->answers()->where('accepted', true)->first();
        if ($existingAcceptedAsnwer instanceof Answer) {
            return redirect()
                ->back()
                ->withErrors("there is already an accepted answer");
        }

        $answer = $question->answers()->where('id', $answerId)->first();
        if (!$answer instanceof Answer) {
            return redirect()
                ->back()
                ->withErrors("the answer you are trying to make as accepted doesn't exist");
        }

        $answer->markAsAccepted();
        $this->reputationActions->increase($answer->user, 15);
        $this->reputationActions->increase($user, 2);

        return redirect()
            ->back()
            ->with("success", "the answer is successfully marked as your accepted answer");
    }
}
