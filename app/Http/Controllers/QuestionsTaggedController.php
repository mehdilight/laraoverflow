<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class QuestionsTaggedController extends Controller
{
    public function index(Tag $tag)
    {
        return view('pages.questions.tagged.index');
    }
}
