<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class QuestionsTaggedController extends Controller
{
    public function index(string $tagName)
    {
        $tag = Tag::query()
            ->where('name', $tagName)
            ->firstOrFail();

        return view('pages.questions.tagged.index', [
            'tag' => $tag
        ]);
    }
}
