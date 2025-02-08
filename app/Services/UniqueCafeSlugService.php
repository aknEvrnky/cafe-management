<?php

namespace App\Services;

use App\Models\Cafe;
use Illuminate\Support\Str;

class UniqueCafeSlugService
{
    public function generate(string $name): string
    {
        $slug = Str::slug($name);

        if (!Cafe::where('slug', $slug)->exists()) {
            return $slug;
        }

        $i = 1;

        while (Cafe::where('slug', sprintf('%s-%d', $slug, $i))->exists()) {
            $i++;
        }

        return sprintf('%s-%d', $slug, $i);
    }
}
