<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cafe;

class CafeController extends Controller
{
    public function __invoke(Cafe $cafe)
    {
        $cafe->loadMissing('productCategories', 'productCategories.products');

        $categories = $cafe->productCategories;
        $products = $cafe->productCategories->pluck('products')->flatten();

        return view('pages.cafe', compact('cafe', 'categories', 'products'));
    }
}
