<?php

namespace App\Models;

use App\Actions\FetchAttributesAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Sushi\Sushi;

class Color extends Model
{
    use Sushi;

    public function getRows(): array
    {
        // Use 'array' driver to only cache for current request
        return Cache::driver('array')->remember('colors', 60, function () {

            $attributes = app(FetchAttributesAction::class)->execute();

            return $attributes->where('code', 'color')->first()->values;
        });
    }
}
