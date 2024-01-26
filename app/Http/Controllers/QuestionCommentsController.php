<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionCommentsController extends Controller
{
    public function store(Question $question, Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $question->comments()->create(
            [
                'user_id' => $user->id,
                'body'    => $request->get('body')
            ]
        );

        return redirect()
            ->back();
    }
}
