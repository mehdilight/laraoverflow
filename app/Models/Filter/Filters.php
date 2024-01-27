<?php

namespace App\Models\Filter;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Filters implements Arrayable
{
    /**
     * @var Collection<Filter>
     */
    private Collection $filters;

    public function __construct(array $filters)
    {
        $this->filters = FiltersCollectionFactory::createFromArray($filters);
    }

    public function findByName(string $filterName): ?Filter
    {
        return $this->filters->first(function (Filter $filter) use ($filterName) {
            return $filter->getField() === $filterName;
        });
    }

    public static function createFromRequest(Request $request): Filters
    {
        return new self($request->get('filters', []));
    }

    /**
     * @return Collection<Filter>
     */
    public function getFilters(): Collection
    {
        return $this->filters;
    }

    public function toArray(): array
    {
        return $this->filters->toArray();
    }
}
