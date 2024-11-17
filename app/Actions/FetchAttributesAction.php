<?php

namespace App\Actions;

use App\DataObjects\AttributeData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class FetchAttributesAction
{
    protected const string API_URL = 'https://draft.grebban.com/backend/attribute_meta.json';

    public function execute(): Collection
    {
        $response = Http::get(self::API_URL);

        return AttributeData::collect($response->json(), Collection::class);
    }
}
