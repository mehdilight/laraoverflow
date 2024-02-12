<?php

namespace App\Http\Controllers\Questions\Answers\Comments;

use App\Http\Controllers\Controller;
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

        $request->validate([
            'body' => ['required', 'max:255']
        ]);

        $comment = $answer->comments()->create(
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
            ->back()
            ->with('success', 'your comment was submitted');
    }
}
