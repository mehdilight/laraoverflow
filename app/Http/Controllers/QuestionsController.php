<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index()
    {
        return view('pages.questions.index');
    }

    public function create()
    {
        return view('pages.questions.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Question $question, ?string $slug = null)
    {
        return view('pages.questions.show');
    }

    public function edit(Question $question)
    {
        //
    }

    public function update(Request $request, Question $question)
    {
        //
    }

    public function destroy(Question $question)
    {
        //
    }
}
