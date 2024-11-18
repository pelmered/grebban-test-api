<?php

namespace App\DataObjects\Transformers;

use App\Models\Category;
use App\Models\Color;
use PhpStaticAnalysis\Attributes\Returns;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class AttributeTransformer implements Transformer
{
    #[Returns("array<int, array{name: 'Category'|'Color', value: string|null}>")]
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): array
    {
        $colors = isset($value['color']) ? $this->getColors($value['color']) : [];

        $categories = isset($value['cat']) ? $this->getCategories($value['cat']) : [];

        return array_filter(array_merge($colors, $categories));
    }

    #[Returns("non-empty-array<int, array{}|array{name: 'Color', value: string|null}>")]
    public function getColors(string $colorsString): array
    {
        return array_map(static function (string $color) {

            $color = Color::where('code', $color)->first();

            if (! $color instanceof Color) {
                return [];
            }

            return [
                'name' => 'Color',
                'value' => $color->name,
            ];
        }, explode(',', $colorsString));
    }

    #[Returns("non-empty-array<int, array{}|array{name: 'Category', value: string|null}>")]
    public function getCategories(string $categoryString): array
    {
        return array_map(static function (string $singleCategoryString) {

            preg_match_all('/\d+/', $singleCategoryString, $matches);

            if (isset($matches[0][1])) {
                $category = Category::where('category_id', $matches[0][1])->where('parent_id', $matches[0][0])->first();
                $parentCategory = Category::where('category_id', $matches[0][0])->where('parent_id', null)->first();

                if (! $category instanceof Category || ! $parentCategory instanceof Category) {
                    return [];
                }

                return [
                    'name' => 'Category',
                    'value' => $parentCategory->name.' > '.$category->name,
                ];
            }

            $category = Category::where('category_id', $matches[0][0])->where('parent_id', null)->first();

            if (! $category instanceof Category) {
                return [];
            }

            return [
                'name' => 'Category',
                'value' => $category->name,
            ];

        }, explode(',', $categoryString));
    }
}
