<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Models\Filter\Filter;
use App\Models\Filter\Filters;
use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuestionsController extends Controller
{
    public function index(Request $request)
    {
        $filters = Filters::createFromRequest($request);
        $this->setDefaultSort($filters);

        $questions = Question::filter($filters)
            ->with('tags', 'user')
            ->withCount('answers')
            ->paginate();

        return view('pages.questions.index', [
            'questions' => $questions,
            'filters'   => $filters
        ]);
    }

    public function create()
    {
        return view('pages.questions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'  => ['required'],
            'body'   => ['required'],
            'tags'   => ['required', 'array'],
            'tags.*' => [sprintf('exists:%s,id', Tag::class)],
        ]);

        /** @var User $user */
        $user = Auth::user();
        /** @var Question $question */
        $question = $user->questions()
            ->create(
                array_merge(
                    Arr::only($validated, ['title', 'body']),
                    [
                        'slug' => Str::slug(Arr::get($validated, 'title'))
                    ]
                )
            );

        $question->tags()->sync(Arr::get($validated, 'tags'));

        return redirect()
            ->route('questions.index');
    }

    public function show(Question $question, string $slug)
    {
        if ($question->slug !== $slug) {
            return redirect()->route('questions.show', [
                'question' => $question,
                'slug'     => $question->slug
            ]);
        }

        $question->loadMissing(['tags', 'answers.comments.user', 'comments.user']);

        return view('pages.questions.show', [
            'question' => $question
        ]);
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

    /**
     * By default the user will see the questions that have most votes score
     *
     * @param Filters $filters
     */
    private function setDefaultSort(Filters $filters)
    {
        $sortFilter = $filters->findByName('sort');
        if ($sortFilter instanceof Filter) {
            return;
        }

        $filters->getFilters()->push(new Filter('sort', 'most_votes'));
    }
}
