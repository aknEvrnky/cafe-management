<?php

namespace App\Models;

use App\Observers\ProductCategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[ObservedBy([ProductCategoryObserver::class])]
class ProductCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ProductCategoryFactory> */
    use HasFactory;

    protected $fillable = ['cafe_id', 'title', 'slug', 'image'];

    public function cafe(): BelongsTo
    {
        return $this->belongsTo(Cafe::class);
    }

    public function imageUrl(): string
    {
        return Storage::url($this->image);
    }

    public static function getUploadImagePath(int $cafeId, string $slug): string
    {
        return sprintf('cafes/%d/product-categories/%s', $cafeId, $slug);
    }
}
