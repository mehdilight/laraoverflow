<?php

namespace App\Http\Controllers\Bookmark;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookmarkQuestionsController extends Controller
{
    public function store(Question $question, string $slug)
    {
        /** @var User $user */
        $user = Auth::user();

        $question->bookmark()->firstOrCreate(
            [
                'user_id'          => $user->id,
                'bookmark_list_id' => 1
            ]
        );

        return redirect()
            ->back()
            ->with('success', 'successfully bookmarked');
    }

    public function destroy(Question $question, string $slug)
    {
        /** @var User $user */
        $user = Auth::user();

        $question->bookmark()
            ->where('user_id', $user->id)
            ->delete();

        return redirect()
            ->back()
            ->with('success', 'removed successfully from your bookmark list');
    }
}
