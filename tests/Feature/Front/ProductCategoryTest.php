<?php

use App\Models\Cafe;
use App\Models\Product;
use App\Models\ProductCategory;

test('can view category page with products', function () {
    // Arrange
    $cafe = Cafe::factory()->create();
    
    $category = ProductCategory::factory()->create([
        'cafe_id' => $cafe->id
    ]);

    Product::factory(5)->create([
        'product_category_id' => $category->id
    ]);

    // Act & Assert
    $response = $this->get(route('product-categories.view', [$cafe, $category]));

    $response->assertStatus(200)
        ->assertViewIs('pages.category')
        ->assertViewHas('cafe', $cafe)
        ->assertViewHas('productCategory', $category)
        ->assertViewHas('products');

    expect($response->viewData('products'))->toHaveCount(5);
});

test('category page loads with empty products', function () {
    // Arrange
    $cafe = Cafe::factory()->create();
    
    $category = ProductCategory::factory()->create([
        'cafe_id' => $cafe->id
    ]);

    // Act & Assert
    $response = $this->get(route('product-categories.view', [$cafe, $category]));

    $response->assertStatus(200)
        ->assertViewIs('pages.category')
        ->assertViewHas('cafe', $cafe)
        ->assertViewHas('productCategory', $category)
        ->assertViewHas('products');

    expect($response->viewData('products'))->toHaveCount(0);
});

test('returns 404 when category does not belong to cafe', function () {
    // Arrange
    $cafe = Cafe::factory()->create();
    $otherCafe = Cafe::factory()->create();
    
    $category = ProductCategory::factory()->create([
        'cafe_id' => $otherCafe->id
    ]);

    // Act & Assert
    $this->get(route('product-categories.view', [$cafe, $category]))
        ->assertStatus(404);
});

test('returns 404 for nonexistent category', function () {
    $cafe = Cafe::factory()->create();

    $this->get(route('product-categories.view', [$cafe, 999]))
        ->assertStatus(404);
}); 