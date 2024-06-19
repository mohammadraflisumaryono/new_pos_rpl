<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-6 months', 'now');
        $updatedAt = (clone $createdAt)->modify('+' . rand(0, 30) . ' days');

        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'total_amount' => $this->faker->randomFloat(1000, 50000, 2000000),
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Canceled', 'Ready', 'On Delivery']),
            'delivery_type' => $this->faker->randomElement(['home_delivery', 'store_pickup']),
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'service_fee' => 5000,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ];
    }
}
