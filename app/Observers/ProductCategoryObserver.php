<?php

namespace App\Observers;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductCategoryObserver
{
    /**
     * Handle the ProductCategory "updated" event.
     */
    public function updated(ProductCategory $productCategory): void
    {
        if ($productCategory->isDirty('image')) {
            Storage::delete($productCategory->getOriginal('image'));
        }
    }

    /**
     * Handle the ProductCategory "deleted" event.
     */
    public function deleted(ProductCategory $productCategory): void
    {
        Storage::delete($productCategory->image);

        $productCategory->products->each(function ($product) {
            $product->delete();
        });
    }
}
