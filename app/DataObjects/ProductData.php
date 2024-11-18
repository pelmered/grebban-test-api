<?php

namespace App\DataObjects;

use App\DataObjects\Transformers\AttributeTransformer;
use PhpStaticAnalysis\Attributes\Param;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;

class ProductData extends Data
{
    #[Param(attributes: "array<int, array{'name': string, 'value': string}>")]
    public function __construct(
        public int $id,
        public string $name,
        #[WithTransformer(AttributeTransformer::class)]
        public array $attributes,
    ) {}
}
