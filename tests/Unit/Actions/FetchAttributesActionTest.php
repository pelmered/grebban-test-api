<?php

use App\Actions\FetchAttributesAction;
use App\DataObjects\AttributeData;

it('executes action and returns products', function () {
    $attributes = app(FetchAttributesAction::class)->execute();

    expect($attributes)->toBeCollection()
        ->and($attributes[0])->toBeInstanceOf(AttributeData::class)
        ->and(count($attributes))->toBe(2);
});
