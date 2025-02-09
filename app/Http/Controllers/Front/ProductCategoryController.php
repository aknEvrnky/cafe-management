<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cafe;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __invoke(Cafe $cafe, ProductCategory $productCategory)
    {
        if ($productCategory->cafe_id !== $cafe->id) {
            abort(404);
        }

        $productCategory->loadMissing('products');

        $products = $productCategory->products;

        return view('pages.category', compact('cafe', 'productCategory', 'products'));
    }
}
