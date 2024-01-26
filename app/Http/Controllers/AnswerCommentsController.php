<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerCommentsController extends Controller
{
    public function store(Question $question, Answer $answer, Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $answer->comments()->create(
            [
                'user_id' => $user->id,
                'body'    => $request->get('answer_comment_body')
            ]
        );

        return redirect()
            ->back();
    }
}
