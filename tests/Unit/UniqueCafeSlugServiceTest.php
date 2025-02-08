<?php

use App\Models\Cafe;
use App\Services\UniqueCafeSlugService;

it('can generate a unique slug for a cafe', function () {
    $cafe = Cafe::factory()->create(['title' => 'The Coffee Shop', 'slug' => 'the-coffee-shop']);

    $uniqueCafeSlugService = new UniqueCafeSlugService();
    $slug = $uniqueCafeSlugService->generate('The Coffee Shop');

    expect($slug)->toBe('the-coffee-shop-1');
});
