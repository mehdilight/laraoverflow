<?php

namespace App\Http\Controllers\Questions\Comments;

use App\Http\Controllers\Controller;
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

        $request->validate([
            'body' => ['required', 'max:255']
        ]);

        $comment = $question->comments()->create(
            [
                'user_id' => $user->id,
                'body'    => $request->get('body')
            ]
        );

        if ($request->expectsJson()) {
            return response()
                ->json(
                    [
                        'created' => true,
                        'data'    => [
                            'comment' => $comment
                        ]
                    ]
                );
        }

        return redirect()
            ->back();
    }
}
