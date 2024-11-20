<?php

use App\Actions\FetchProductsAction;
use App\DataObjects\ProductData;

it('executes action and returns products', static function () {
    $products = app(FetchProductsAction::class)->execute();

    expect($products)->toBeCollection()
        ->and($products[0])->toBeInstanceOf(ProductData::class)
        ->and(count($products))->toBe(9);
});
