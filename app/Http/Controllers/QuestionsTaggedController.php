<?php

namespace App\Http\Controllers;

use App\Models\Filter\Filters;
use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;

class QuestionsTaggedController extends Controller
{
    public function index(string $tagName, Request $request)
    {
        /** @var Tag $tag */
        $tag = Tag::query()
            ->where('name', $tagName)
            ->firstOrFail();

        $filters = Filters::createFromRequest($request);
        $this->setDefaultSort($filters, $tag);

        $questions = Question::filter($filters)
            ->with('tags', 'user')
            ->withCount('answers')
            ->paginate();

        return view('pages.questions.tagged.index', [
            'tag'       => $tag,
            'questions' => $questions,
            'filters'   => $filters
        ]);
    }

    private function setDefaultSort(Filters $filters, Tag $tag)
    {
        if ($filters->filterDoesNotExist('tags')) {
            $filters->pushNewFilter(
                'tags',
                $tag->getAttribute('id')
            );
        }

        if ($filters->filterDoesNotExist('sort')) {
            $filters->pushNewFilter(
                'sort',
                'most_votes'
            );
        }
    }
}
