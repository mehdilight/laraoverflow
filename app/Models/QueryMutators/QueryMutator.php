<?php

namespace App\Models\QueryMutators;

use App\Models\Filter\Filters;
use Illuminate\Database\Eloquent\Builder;

class QueryMutator
{
    public function __construct(
        private Builder $query,
        private Filters $filters
    )
    {}

    public function getQuery(): Builder
    {
        return $this->query;
    }

    public function setQuery(Builder $query): void
    {
        $this->query = $query;
    }

    public function getFilters(): Filters
    {
        return $this->filters;
    }

    public function setFilters(Filters $filters): void
    {
        $this->filters = $filters;
    }
}
