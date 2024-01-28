<?php

namespace App\Models\QueryMutators\Question;

use App\Models\Filter\Filter;
use App\Models\QueryMutators\AbstractMutatorHandler;
use Illuminate\Database\Eloquent\Builder;

class TagsMutator extends AbstractMutatorHandler
{
    protected function getFilterName(): string
    {
        return 'tags';
    }

    protected function mutate(Builder $query, Filter $filter)
    {
        $value = $filter->getValue();

        if (is_array($value)) {
            $query->whereHas('tags', function (Builder $q) use ($value) {
                return $q->whereIn('tags.id', $value);
            });

            return;
        }

        $query->join('question_tag', 'questions.id', '=', 'question_tag.question_id')
            ->join('tags', 'tags.id', '=', 'question_tag.tag_id')
            ->when(is_array($value), function (Builder $builder) use ($value) {
                $builder->whereIn('tags.id', $value);
            })
            ->when(is_numeric($value), function (Builder $builder) use ($value) {
                $builder->where('tags.id', $value);
            });
    }
}
