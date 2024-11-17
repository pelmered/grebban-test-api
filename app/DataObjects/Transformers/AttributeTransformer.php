<?php

namespace App\DataObjects\Transformers;

use App\Models\Category;
use App\Models\Color;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class AttributeTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): array
    {
        $colors = isset($value['color']) ? $this->getColors($value['color']) : [];

        $categories = isset($value['cat']) ? $this->getCategories($value['cat']) : [];

        return array_merge($colors, $categories);
    }

    public function getColors($colorsString): array
    {
        return array_map(function ($color) {

            $color = Color::where('code', $color)->first();

            return [
                'name' => 'Color',
                'value' => $color->name,
            ];
        }, explode(',', $colorsString));
    }

    public function getCategories($categoryString): array
    {
        return array_map(function ($singleCategoryString) {

            preg_match_all('/\d+/', $singleCategoryString, $matches);

            if (isset($matches[0][1])) {
                $category = Category::where('id', $matches[0][1])->where('parent_id', $matches[0][0])->first();
                $parentCategory = Category::where('id', $matches[0][0])->where('parent_id', null)->first();

                return [
                    'name' => 'Category',
                    'value' => $parentCategory->name.' > '.$category->name,
                ];
            }

            return [
                'name' => 'Category',
                'value' => Category::where('id', $matches[0][0])->where('parent_id', null)->first()?->name,

            ];
        }, explode(',', $categoryString));
    }
}
