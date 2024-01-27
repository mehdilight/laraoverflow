<?php

namespace App\Models\QueryMutators\Question;

use App\Models\Filter\Filter;
use App\Models\QueryMutators\AbstractMutatorHandler;
use Illuminate\Database\Eloquent\Builder;

class SortingMutator extends AbstractMutatorHandler
{
    protected function getFilterName(): string
    {
        return 'sort';
    }

    protected function mutate(Builder $query, Filter $filter)
    {
        $query->when($filter->getValue() === 'newest', function (Builder $query) {
            return $query->latest();
        });

        $query->when($filter->getValue() === 'unanswered', function (Builder $query) {
            return $query->whereDoesntHave('answers');
        });

        $query->when($filter->getValue() === 'most_scores', function (Builder $query) {
            return $query->orderByDesc('votes_score');
        });
    }
}
