<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->word,
            'barcode' => $this->faker->isbn13,
            'image' => $this->faker->imageUrl(),
            'harga' => $this->faker->randomFloat(2, 10000, 500000),
            'netto' => $this->faker->randomFloat(2, 500, 2000),
            'dimensi' => $this->faker->randomElement(['10x10x20 cm', '8x8x15 cm', '12x12x25 cm']),
            'deskripsi' => $this->faker->sentence(10),
            'category_id' => \App\Models\Category::inRandomOrder()->first()->category_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
