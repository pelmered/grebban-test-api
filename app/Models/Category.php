<?php

namespace App\Models;

use App\Actions\FetchAttributesAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Sushi\Sushi;

class Category extends Model
{
    use Sushi;

    protected array $schema = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'name' => 'string',
    ];

    public function getRows(): array
    {
        // Use 'array' driver to only cache for current request
        return Cache::driver('array')->remember('categories', 60, function () {

            $attributes = app(FetchAttributesAction::class)->execute();

            $categories = $attributes->where('code', 'cat')->first();

            return array_map(static function ($category) {

                preg_match_all('/\d+/', $category['code'], $matches);

                if (isset($matches[0][1])) {
                    return [
                        'id' => $matches[0][1],
                        'parent_id' => $matches[0][0],
                        'name' => $category['name'],
                    ];
                }

                return [
                    'id' => $matches[0][0],
                    'parent_id' => null,
                    'name' => $category['name'],
                ];
            }, $categories->values);
        });
    }
}
