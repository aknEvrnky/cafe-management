<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\ProductCategory\CreateProductCategoryRequest;
use App\Http\Resources\ProductCategoryResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $user->loadMissing('currentCafe.productCategories');

        $productCategories = $user->currentCafe->productCategories;

        return Inertia::render('ProductCategory/Index', [
            'productCategories' => ProductCategoryResource::collection($productCategories),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('ProductCategory/Create');
    }

    public function store(CreateProductCategoryRequest $request): RedirectResponse
    {
        $request->validated();

        $user = $request->user();

        $imagePath = sprintf('cafes/%d/product-categories/%s', $user->current_cafe_id, $request->slug);
        $image = $request->file('image');

        $fileName = sprintf('%s/%s', $imagePath, $image->hashName());

        Storage::putFile($imagePath, $image, 'public');

        $user->currentCafe->productCategories()->create([
            'title' => $request->title,
            'slug' => $request->slug,
            'image' => $fileName,
        ]);

        return to_route('product-categories.index')->with('success', 'Ürün kategorisi başarıyla oluşturuldu.');
    }
}
