<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();

        Http::fake([
            'https://draft.grebban.com/backend/products.json' => Http::response(file_get_contents(base_path('tests/Data/products.json'))),
        ]);
        Http::fake([
            'https://draft.grebban.com/backend/attribute_meta.json' => Http::response(file_get_contents(base_path('tests/Data/attribute_meta.json'))),
        ]);
    }
}
