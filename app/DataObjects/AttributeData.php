<?php

namespace App\DataObjects;

use PhpStaticAnalysis\Attributes\Param;
use Spatie\LaravelData\Data;

class AttributeData extends Data
{
    #[Param(values: "array<int, array{'name': string, 'value': string}>")]
    public function __construct(
        public string $name,
        public string $code,
        public array $values,
    ) {}
}
