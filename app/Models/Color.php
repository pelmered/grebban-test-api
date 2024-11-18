<?php

namespace App\Models;

use App\Actions\FetchAttributesAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use PhpStaticAnalysis\Attributes\Returns;
use Sushi\Sushi;

/**
 * @mixin IdeHelperColor
 */
#[\AllowDynamicProperties]
class Color extends Model
{
    use Sushi;

    #[Returns("array<int, array{'name': string, 'value': string}>")]
    public function getRows(): ?array
    {
        // Use 'array' driver to only cache for current request
        return Cache::driver('array')->remember('colors', 60, function () {

            $attributes = app(FetchAttributesAction::class)->execute();

            return $attributes->where('code', 'color')->first()?->values;
        });
    }
}
