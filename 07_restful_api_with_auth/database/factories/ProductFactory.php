<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word();
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Get a random user ID
            'brand_id' => Brand::inRandomOrder()->first()->id, // Get a random brand ID
            'category_id' => Category::inRandomOrder()->first()->id, // Get a random category ID
            'name' => $name,
            'price' => $this->faker->randomFloat(2, 10, 10000),
            'description' => $this->faker->sentence(),
            'image' => $name.'.png',
        ];
    }
}