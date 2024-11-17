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

    public function execute()
    {
        $attributes = $this->fetchAttributesAction->execute();
        $products = $this->fetchProductsAction->execute();

        // WIP
    }
}
