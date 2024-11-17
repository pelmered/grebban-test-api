<?php

use Illuminate\Testing\Fluent\AssertableJson;

it('makes an api request', function () {

    $response = $this->getJson('/product');

    $response
        ->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has('products')
                 ->has('products.0', fn ($json) =>
                     $json->where('id', 2169396)
                          ->where('name', 'Auto Alpha')
                          ->where('attributes.0.name', 'Color')
                          ->where('attributes.0.value', 'Blue')
                          ->where('attributes.1.name', 'Color')
                          ->where('attributes.1.value', 'Green')
                          ->where('attributes.2.name', 'Category')
                          ->where('attributes.2.value', 'Cars > Hybrids')
            )
        );
});

it('limits results by page size', function ($perPage, $resultCount) {
    $response = $this->getJson('/product?page=1&page_size='.$perPage);

    $response
        ->assertStatus(200)
        ->assertJson(function (AssertableJson $json) use ($resultCount) {
            $json->has('products', $resultCount)->etc();
        });
})->with([
    [1, 1],
    [3, 3],
    [5, 5],
    [10, 10],
    [999999, 100],
]);

it('returns the correct page', function ($page) {

})->with([
]);
