<?php

use App\Models\Cafe;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;

test('user can view products page', function () {
    $cafe = Cafe::factory()->create();
    $user = $cafe->owner;

    $user->switchCafe($cafe);

    $productCategory = ProductCategory::factory()->create([
        'cafe_id' => $cafe->id,
    ]);

    Product::factory(10)->create([
        'product_category_id' => $productCategory->id,
    ]);

    $this->actingAs($user);

    $this->get('/dashboard/products')
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('Product/Index')
            ->has('products', 10)
        );
});

test('user can view create product page', function () {
    $cafe = Cafe::factory()->create();
    $user = $cafe->owner;

    $user->switchCafe($cafe);

    ProductCategory::factory(5)->create([
        'cafe_id' => $cafe->id,
    ]);

    ProductCategory::factory(3)->create();

    $this->actingAs($user);

    $this->get('/dashboard/products/create')
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page
            ->component('Product/Create')
            ->has('productCategories', 5)
        );
});

test('user can create product', function () {
    Storage::fake();

    $cafe = Cafe::factory()->create();
    $user = $cafe->owner;
    $user->switchCafe($cafe);

    $productCategory = ProductCategory::factory()->create([
        'cafe_id' => $cafe->id,
    ]);

    $this->actingAs($user);

    $file = UploadedFile::fake()->image('product.jpg');

    $this->post('/dashboard/products', [
        'product_category_id' => $productCategory->id,
        'title' => 'Product Title',
        'slug' => 'product-title',
        'description' => 'Product Description',
        'price' => 1000,
        'image' => $file,
    ])->assertSessionHasNoErrors()
        ->assertRedirect('/dashboard/products');

    $fileName = 'cafes/1/products/product-title/' . $file->hashName();
    Storage::assertExists($fileName);

    $this->assertDatabaseHas('products', [
        'product_category_id' => $productCategory->id,
        'title' => 'Product Title',
        'slug' => 'product-title',
        'description' => 'Product Description',
        'price' => 1000,
        'image' => $fileName,
    ]);
});

test('user can delete product', function () {
    Storage::fake();

    $cafe = Cafe::factory()->create();
    $user = $cafe->owner;
    $user->switchCafe($cafe);

    $productCategory = ProductCategory::factory()->create([
        'cafe_id' => $cafe->id,
    ]);

    $product = Product::factory()->create([
        'product_category_id' => $productCategory->id,
    ]);

    $this->actingAs($user);

    $this->delete('/dashboard/products/' . $product->id)
        ->assertSessionHasNoErrors()
        ->assertRedirect('/dashboard/products');

    $fileName = 'cafes/1/products/' . $product->slug . '/' . $product->image;
    Storage::assertMissing($fileName);

    $this->assertDatabaseMissing('products', [
        'id' => $product->id,
    ]);
});

test('user can update product', function () {
    Storage::fake();

    $cafe = Cafe::factory()->create();
    $user = $cafe->owner;
    $user->switchCafe($cafe);

    $productCategory = ProductCategory::factory()->create([
        'cafe_id' => $cafe->id,
    ]);

    $filePath = 'cafes/1/products/test-product';

    $oldFile = UploadedFile::fake()->image('old.jpg');
    Storage::putFile($filePath, $oldFile);

    $product = Product::factory()->create([
        'product_category_id' => $productCategory->id,
        'title' => 'Test Product',
        'slug' => 'test-product',
        'description' => 'Test Description',
        'price' => 1000,
        'image' => sprintf('%s/%s', $filePath, $oldFile->hashName()),
    ]);

    $this->actingAs($user);

    $newFile = UploadedFile::fake()->image('new.jpg');

    $this->patch('/dashboard/products/' . $product->id, [
        'product_category_id' => $productCategory->id,
        'title' => 'Updated Product',
        'description' => 'Updated Description',
        'price' => 2000,
        'image' => $newFile,
    ])->assertSessionHasNoErrors()
        ->assertRedirect("/dashboard/products/$product->id/edit");

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'product_category_id' => $productCategory->id,
        'title' => 'Updated Product',
        'slug' => 'test-product', // slug değişmemeli
        'description' => 'Updated Description',
        'price' => 2000,
        'image' => $filePath . '/' . $newFile->hashName(),
    ]);

    Storage::assertExists($filePath . '/' . $newFile->hashName());
    Storage::assertMissing($filePath . '/' . $oldFile->hashName());
});
