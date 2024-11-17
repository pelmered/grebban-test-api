<?php

use Illuminate\Testing\Fluent\AssertableJson;

it('makes an api request', function () {

    //$response = $this->getJson('/product');
    $response = $this->getJson(route('api.products'));

    $response
        ->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) => $json->has('products')
            ->has('products.0', fn ($json) => $json->where('id', 6267654)
                ->where('name', 'Auto Omega')
                ->where('attributes.0.name', 'Color')
                ->where('attributes.0.value', 'Black')
                ->where('attributes.1.name', 'Color')
                ->where('attributes.1.value', 'White')
                ->where('attributes.2.name', 'Category')
                ->where('attributes.2.value', 'Cars')
            )->etc()
        );
});

it('matches snapshots', function () {

    $response = $this->getJson('/product');

    expect($response)->toMatchSnapshot();
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
    [10, 9],
    [999999, 9],
]);

it('returns the correct page', function ($page) {

})->with([
]);
