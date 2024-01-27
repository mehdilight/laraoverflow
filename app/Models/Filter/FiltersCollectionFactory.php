<?php

namespace App\Models\Filter;

use Illuminate\Support\Collection;

abstract class FiltersCollectionFactory
{
    public static function createFromArray(array $attributes): Collection
    {
        $collection = Collection::make();

        foreach ($attributes as $filterField => $filterValue) {
            $collection->push(
                new Filter($filterField, $filterValue)
            );
        }

        return $collection;
    }
}
