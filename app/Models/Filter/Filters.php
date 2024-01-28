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

    public function generateFilterLink(string $field, string $filterValue): string
    {
        return '?'. $this->filters
            ->map(function (Filter $filter) {
                return sprintf('filters[%s]=%s', $filter->getField(), $filter->getValue());
            })
            ->reject(function (string $filterQuery) use ($field, $filterValue) {
                [$filter] = explode('=', $filterQuery);

                return $filter === sprintf('filters[%s]', $field);
            })
            ->push(sprintf('filters[%s]=%s', $field, $filterValue))
            ->join('&');
    }

    public function pushNewFilter(string $filterName, mixed $value): self
    {
        $this->filters->push(new Filter($filterName, $value));

        return $this;
    }

    public function filterExists(string $field): bool
    {
        return $this->findByName($field) instanceof Filter;
    }

    public function filterDoesNotExist(string $field): bool
    {
        return !$this->filterExists($field);
    }
}
