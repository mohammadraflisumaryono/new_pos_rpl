<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TransactionDetailFactory extends Factory
{
    protected $model = TransactionDetail::class;

    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-6 months', 'now');
        $updatedAt = (clone $createdAt)->modify('+' . rand(0, 30) . ' days');
        $productId = Product::inRandomOrder()->value('id');

        return [
            'transaction_id' => Transaction::factory(),
            'product_id' => $productId,
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ];
    }
}
