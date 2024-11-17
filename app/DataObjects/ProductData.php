<?php

namespace App\DataObjects;

use App\DataObjects\Transformers\AttributeTransformer;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        #[WithTransformer(AttributeTransformer::class)]
        public array $attributes,
    ) {}
}
