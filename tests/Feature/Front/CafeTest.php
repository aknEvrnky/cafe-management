<?php

use App\Models\Cafe;
use App\Models\Product;
use App\Models\ProductCategory;

test('can view cafe page with categories and products', function () {
    // Arrange
    $cafe = Cafe::factory()->create();
    
    $categories = ProductCategory::factory(3)->create([
        'cafe_id' => $cafe->id
    ]);

    foreach ($categories as $category) {
        Product::factory(2)->create([
            'product_category_id' => $category->id
        ]);
    }

    // Act & Assert
    $response = $this->get(route('cafes.view', $cafe));

    $response->assertStatus(200)
        ->assertViewIs('pages.cafe')
        ->assertViewHas('cafe', $cafe)
        ->assertViewHas('categories')
        ->assertViewHas('products');

    expect($response->viewData('categories'))->toHaveCount(3)
        ->and($response->viewData('products'))->toHaveCount(6);
});

test('cafe page loads with empty categories', function () {
    // Arrange
    $cafe = Cafe::factory()->create();

    // Act & Assert
    $response = $this->get(route('cafes.view', $cafe));

    $response->assertStatus(200)
        ->assertViewIs('pages.cafe')
        ->assertViewHas('cafe', $cafe)
        ->assertViewHas('categories')
        ->assertViewHas('products');

    expect($response->viewData('categories'))->toHaveCount(0)
        ->and($response->viewData('products'))->toHaveCount(0);
});

test('cafe page returns 404 for nonexistent cafe', function () {
    $this->get(route('cafes.view', 999))
        ->assertStatus(404);
}); 