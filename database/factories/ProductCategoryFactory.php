<?php

namespace Database\Factories;

use App\Models\Cafe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cafe_id' => Cafe::factory(),
            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'image' => $this->faker->imageUrl(),
        ];
    }
}
