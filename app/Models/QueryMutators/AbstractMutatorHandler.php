<?php

namespace App\Models\QueryMutators;

use App\Models\Filter\Filter;
use Closure;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractMutatorHandler
{
    public function handle(QueryMutator $queryMutator, Closure $next): QueryMutator
    {
        $filter = $queryMutator->getFilters()->findByName($this->getFilterName());
        if (!$filter instanceof Filter) {
            return $next($queryMutator);
        }

        $this->mutate(
            $queryMutator->getQuery(),
            $filter
        );

        return $next($queryMutator);
    }

    abstract protected function getFilterName(): string;

    abstract protected function mutate(Builder $query, Filter $filter);
}
