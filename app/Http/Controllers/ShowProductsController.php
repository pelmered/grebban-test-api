<?php

namespace App\Http\Controllers;

use App\Actions\FetchAllProductDataAction;
use App\DataObjects\ProductData;
use App\Http\Resources\ProductCollectionResource;
use Illuminate\Http\Request;

class ShowProductsController extends Controller
{
    public function __invoke(Request $request, FetchAllProductDataAction $fetchAllProductDataAction)
    {
        $products = $fetchAllProductDataAction->execute()['products'];

        return new ProductCollectionResource($products);
    }
}
