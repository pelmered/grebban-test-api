<?php

namespace App\DataObjects;

use Spatie\LaravelData\Data;

class AttributeData extends Data
{
    public function __construct(
        public string $name,
        public string $code,
        public array $values,
    ) {}
}
