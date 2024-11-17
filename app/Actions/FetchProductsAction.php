<?php

namespace App\Actions;

use App\DataObjects\ProductData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class FetchProductsAction
{
    protected const string API_URL = 'https://draft.grebban.com/backend/products.json';

    public function execute(): Collection
    {
        $response = Http::get(self::API_URL);

        return ProductData::collect($response->json(), Collection::class);
    }
}
