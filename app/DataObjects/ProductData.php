<?php

namespace App\DataObjects;

use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public array $attributes,
    ) {}

    # TODO /  WIP
    protected function parseAttributes(array $attributes): array
    {
        return array_map(function ($attribute) {
            return new AttributeData($attribute['name'], $attribute['value']);
        }, $attributes);
    }
}
