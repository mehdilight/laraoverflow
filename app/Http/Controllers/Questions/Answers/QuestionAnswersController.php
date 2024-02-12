<?php

namespace App\Http\Controllers\Questions\Answers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionAnswersController extends Controller
{
    public function store(Question $question, Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'answer_body' => ['required']
        ]);

        $question->answers()->create(
            [
                'body'    => $request->get('answer_body'),
                'user_id' => $user->id
            ]
        );

        return redirect()
            ->back()
            ->with('success', 'your answer is successfully submit');
    }
}
