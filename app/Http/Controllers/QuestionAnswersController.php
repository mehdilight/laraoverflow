<?php

namespace App\Http\Controllers;

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

        $question->answers()->create(
            [
                'body'    => $request->get('answer_body'),
                'user_id' => $user->id
            ]
        );

        return redirect()
            ->back();
    }
}
