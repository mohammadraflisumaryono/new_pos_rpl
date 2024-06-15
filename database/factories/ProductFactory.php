<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-6 months', 'now');
        $updatedAt = (clone $createdAt)->modify('+' . rand(0, 30) . ' days');

        return [
            'nama' => $this->faker->word,
            'barcode' => $this->faker->ean13,
            'image' => $this->faker->imageUrl(640, 480, 'product'),
            'harga' => $this->faker->randomFloat(2, 1000, 1000000),
            'netto' => $this->faker->randomFloat(2, 1, 1000),
            'dimensi' => $this->faker->randomElement(['5x5x5 cm', '10x10x10 cm', '20x20x20 cm']),
            'deskripsi' => $this->faker->paragraph,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ];
    }
}
