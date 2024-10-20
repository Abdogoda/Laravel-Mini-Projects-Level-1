<?php

namespace Database\Factories;

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
        $categories = ['Electronics', 'Kitchen Tools', 'TV', 'Mobile', 'Watch', 'Laptop', 'Sports'];
        $name = $this->faker->word();
        return [
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 10000),
            'category' => $this->faker->randomElement($categories),
            'image' => 'https://fakeimg.pl/200x200/?text='.$name,
        ];
    }
}