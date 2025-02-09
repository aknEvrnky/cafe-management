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

test('user can delete the product category', function () {
    Storage::fake();

    $cafe = Cafe::factory()->create();
    $user = $cafe->owner;
    $user->switchCafe($cafe);

    $productCategory = ProductCategory::factory()->create([
        'cafe_id' => $cafe->id,
    ]);

    $this->actingAs($user);

    $this->delete('dashboard/product-categories/' . $productCategory->id)
        ->assertSessionHasNoErrors()
        ->assertRedirect('dashboard/product-categories');

    $fileName = 'cafes/1/product-categories/' . $productCategory->slug . '/' . $productCategory->image;
    Storage::assertMissing($fileName);
});

test('user can update product category', function () {
    Storage::fake();

    $cafe = Cafe::factory()->create();
    $user = $cafe->owner;
    $user->switchCafe($cafe);

    $filePath = ProductCategory::getUploadImagePath(1, 'test');

    $oldFile = UploadedFile::fake()->image('avatar.jpg');
    Storage::putFile($filePath, $oldFile);

    $productCategory = ProductCategory::factory()->create([
        'cafe_id' => $cafe->id,
        'image' => sprintf('%s/%s', $filePath, $oldFile->hashName()),
        'slug' => 'test',
        'title' => 'Test',
    ]);

    $this->actingAs($user);

    $newFile = UploadedFile::fake()->image('new.jpg');

    $this->put('dashboard/product-categories/' . $productCategory->id, [
        'title' => 'Test Product Category',
        'image' => $newFile,
    ])->assertSessionHasNoErrors()
        ->assertRedirect('dashboard/product-categories');

    $this->assertDatabaseHas('product_categories', [
        'id' => $productCategory->id,
        'title' => 'Test Product Category',
        'slug' => 'test',
        'image' => 'cafes/1/product-categories/test/' . $newFile->hashName(),
    ]);

    Storage::assertExists($filePath . '/' . $newFile->hashName());
    Storage::assertMissing($filePath . '/'  . $oldFile->hashName());
});
