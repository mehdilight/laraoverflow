<?php

namespace App\Http\Controllers\Questions\Answers\Bookmarks;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookmarkAnswersController extends Controller
{
    public function store(Question $question, Answer $answer)
    {
        /** @var User $user */
        $user = Auth::user();

        $answer->bookmark()->firstOrCreate(
            [
                'user_id'          => $user->id,
                'bookmark_list_id' => 1,
                'question_id'      => $question->id
            ]
        );

        return redirect()
            ->back();
    }

    public function destroy(Question $question, Answer $answer)
    {
        /** @var User $user */
        $user = Auth::user();

        $answer->bookmark()
            ->where('user_id', $user->id)
            ->delete();

        return redirect()
            ->back();
    }
}
