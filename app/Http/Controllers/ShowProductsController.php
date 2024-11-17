<?php

namespace App\Http\Controllers;

use App\Actions\FetchAllProductDataAction;
use App\Actions\FetchProductsAction;
use App\DataObjects\ProductData;
use App\Http\Resources\ProductCollectionResource;
use Illuminate\Http\Request;

class ShowProductsController extends Controller
{
    public function __invoke(Request $request, FetchProductsAction $fetchProductsAction)
    {
        $products = $fetchProductsAction->execute();

        return new ProductCollectionResource($products);
    }
}
