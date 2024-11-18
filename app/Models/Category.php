<?php

namespace App\Models;

use App\Actions\FetchAttributesAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use PhpStaticAnalysis\Attributes\Returns;
use PhpStaticAnalysis\Attributes\Type;
use Sushi\Sushi;

/**
 * @mixin IdeHelperCategory
 */
#[\AllowDynamicProperties]
class Category extends Model
{
    use Sushi;

    #[Type('array<string, string>')]
    protected array $schema = [
        'category_id' => 'integer',
        'parent_id' => 'integer',
        'name' => 'string',
    ];

    #[Returns("array<array{'category_id': int, 'parent_id': int|null, 'name': string}>")]
    public function getRows(): ?array
    {
        // Use 'array' driver to only cache for current request
        return Cache::driver('array')->remember('categories', 60, function () {

            $attributes = app(FetchAttributesAction::class)->execute();

            /** @var array<array{'name': string, 'code': string}> $categories */
            $categories = $attributes->where('code', 'cat')->first()?->values;

            return array_map(static function (array $category) {

                preg_match_all('/\d+/', $category['code'], $matches);

                if (isset($matches[0][1])) {
                    return [
                        'category_id' => (int) $matches[0][1],
                        'parent_id' => (int) $matches[0][0],
                        'name' => $category['name'],
                    ];
                }

                return [
                    'category_id' => (int) $matches[0][0],
                    'parent_id' => null,
                    'name' => $category['name'],
                ];
            }, $categories);
        });
    }
}
