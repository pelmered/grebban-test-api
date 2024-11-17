<?php
namespace App\Actions;

use Illuminate\Support\Facades\Http;

class FetchAllProductDataAction
{
    public function __construct(
        private FetchAttributesAction $fetchAttributesAction,
        private FetchProductsAction $fetchProductsAction
    )
    {}

    public function execute(): array
    {
        $attributes = $this->fetchAttributesAction->execute();
        $products = $this->fetchProductsAction->execute();

        return [
            'attributes' => $attributes,
            'products'   => $products,
        ];
    }
}
