<?php

it('can generate image upload path', function () {
    $cafeId = 1;
    $slug = 'test-slug';

    $expected = 'cafes/1/product-categories/test-slug';

    $result = \App\Models\ProductCategory::getUploadImagePath($cafeId, $slug);

    expect($result)->toBe($expected);
});
