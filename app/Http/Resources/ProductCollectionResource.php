<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use PhpStaticAnalysis\Attributes\Param;
use PhpStaticAnalysis\Attributes\Returns;

class ProductCollectionResource extends ResourceCollection
{
    public static $wrap = 'products';

    #[Param(paginated: 'array<string, mixed>')]
    #[Param(default: 'array<string, mixed>')]
    #[Returns('array<string, mixed>')]
    public function paginationInformation(Request $request, array $paginated, array $default): array
    {
        return [
            'page' => $paginated['current_page'],
            'totalPages' => $paginated['last_page'],
        ];
    }
}
