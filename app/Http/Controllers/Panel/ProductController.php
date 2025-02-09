<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Product\CreateProductRequest;
use App\Http\Requests\Panel\Product\UpdateProductRequest;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('productCategory')
            ->whereHas('productCategory', function ($query) {
                $query->where('cafe_id', auth()->user()->current_cafe_id);
            })->get();

        return inertia('Product/Index', [
            'products' => ProductResource::collection($products),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cafe = auth()->user()->currentCafe;
        $cafe->load('productCategories');

        $productCategories = ProductCategoryResource::collection($cafe->productCategories);

        return inertia('Product/Create', [
            'productCategories' => $productCategories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $request->validated();
        $productCategoryId = $request->get('product_category_id');
        $cafe = auth()->user()->currentCafe;

        $filePath = Product::getUploadImagePath($cafe->id, $request->get('slug'));
        $file = $request->file('image');

        Storage::putFile($filePath, $file, 'public');
        $fileName = sprintf('%s/%s', $filePath, $file->hashName());

        $product = Product::create([
            'product_category_id' => $productCategoryId,
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'image' => $fileName,
        ]);

        return to_route('products.index')->with('success', 'Ürün başarıyla oluşturuldu.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $cafe = auth()->user()->currentCafe;
        $cafe->load('productCategories');
        $product->loadMissing('productCategory');

        return inertia('Product/Edit', [
            'product' => new ProductResource($product),
            'productCategories' =>  ProductCategoryResource::collection($cafe->productCategories),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $attributes = $request->validated();

        if ($request->hasFile('image')) {
            $filePath = Product::getUploadImagePath($product->productCategory->cafe_id, $product->slug);
            $file = $request->file('image');

            Storage::putFile($filePath, $file, 'public');
            $fileName = sprintf('%s/%s', $filePath, $file->hashName());

            $attributes['image'] = $fileName;
        }

        $attributes = array_filter($attributes);

        $product->update($attributes);

        return to_route('products.edit', $product)->with('success', 'Ürün başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products.index')->with('success', 'Ürün başarıyla silindi.');
    }
}
