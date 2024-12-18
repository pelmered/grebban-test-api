<?php

namespace App\Http\Controllers;

use App\Actions\FetchProductsAction;
use App\Http\Resources\ProductCollectionResource;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ShowProductsController extends Controller
{
    public function __invoke(Request $request, FetchProductsAction $fetchProductsAction): ProductCollectionResource
    {
        $products = $fetchProductsAction->execute();

        $totalCount = $products->count();
        $pageSize = (int) ($request->input('page_size') ?? 5);
        $currentPage = (int) ($request->input('page') ?? 1);

        $products = $products->slice(($currentPage - 1) * $pageSize, $pageSize);

        $products = new LengthAwarePaginator(
            $products,
            $totalCount,
            $pageSize,
            $currentPage,
        );

        return new ProductCollectionResource($products);
    }
}
