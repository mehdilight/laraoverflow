<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Bookmark;
use App\Models\Filter\Filter;
use App\Models\Filter\Filters;
use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Builder;
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

        $question->loadMissing([
            'user',
            'tags',
            'answers.user',
            'answers.comments.user',
            'comments.user'
        ]);

        $user = Auth::user();
        $this->setUserRelations($user, $question);

        return view('pages.questions.show', [
            'question' => $question,
            'user'     => $user
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

    private function setUserRelations(User $user, Question $question)
    {
        $questionId = $question->id;
        $answersIds = $question->answers->pluck('id')->toArray();

        $votes = Vote::query()
            ->where(function (Builder $query) use ($user, $questionId) {
                $query->where('votable_type', Question::class)
                    ->where('votable_id', $questionId)
                    ->where('user_id', $user->id);
            })
            ->orWhere(function (Builder $query) use ($user, $answersIds, $questionId) {
                $query->where('votable_type', Answer::class)
                    ->whereIn('votable_id', $answersIds)
                    ->where('user_id', $user->id);
            })
            ->get();

        $bookmarks = Bookmark::query()
            ->where('question_id', $question->id)
            ->get();

        $user->setRelation('votes', $votes);
        $user->setRelation('bookmarks', $bookmarks);
    }
}
