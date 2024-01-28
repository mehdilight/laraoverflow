<?php

namespace App\Models\Filter;


use Illuminate\Contracts\Support\Arrayable;

class Filter implements Arrayable
{
    private const VALUE_ATTRIBUTE = 'value';
    private const FIELD_ATTRIBUTE = 'field';

    public function __construct(private string $field, private mixed $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [
            self::VALUE_ATTRIBUTE    => $this->value,
            self::FIELD_ATTRIBUTE    => $this->field,
        ];
    }
}
