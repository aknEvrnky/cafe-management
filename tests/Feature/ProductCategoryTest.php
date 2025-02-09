<?php

use App\Models\Cafe;
use App\Models\ProductCategory;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia as Assert;

test('user can view the product categories page', function () {
    $cafe = Cafe::factory()->create();
    $user = $cafe->owner;

    $user->switchCafe($cafe);

    ProductCategory::factory(10)->create([
        'cafe_id' => $cafe->id,
    ]);

    $otherCafe = Cafe::factory()->create();
    $otherCafeProductCategory = ProductCategory::factory()->create([
        'cafe_id' => $otherCafe->id,
    ]);

    $this->actingAs($user);

    $this->get('/dashboard/product-categories')
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('ProductCategory/Index')
            ->has('productCategories', 10)
            ->has('productCategories.9', fn(Assert $page) => $page
                ->where('id', 10)
                ->etc()
            )
        );
});

test('user can view create product category page', function () {
    $cafe = Cafe::factory()->create();
    $user = $cafe->owner;

    $user->switchCafe($cafe);

    $this->actingAs($user);

    $this->get('/dashboard/product-categories/create')
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('ProductCategory/Create')
        );
});

test('user can create product category', function () {
    Storage::fake();

    $cafe = Cafe::factory()->create();
    $user = $cafe->owner;
    $user->switchCafe($cafe);

    $this->actingAs($user);

    $file = UploadedFile::fake()->image('avatar.jpg');

    $this->post('dashboard/product-categories', [
        'title' => 'Test Product Category',
        'slug' => 'test',
        'image' => $file,
    ])->assertSessionHasNoErrors()
        ->assertRedirect('dashboard/product-categories');

    $fileName = 'cafes/1/product-categories/test/' . $file->hashName();
    Storage::assertExists($fileName);
});
