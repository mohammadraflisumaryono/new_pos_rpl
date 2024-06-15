<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-6 months', 'now');
        $updatedAt = (clone $createdAt)->modify('+' . rand(0, 30) . ' days');

        return [
            'name' => $this->faker->name,
            'role' => $this->faker->numberBetween(1, 5),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->optional()->dateTimeBetween('-6 months', 'now'),
            'password' => Hash::make('password'), // Default password
            'remember_token' => Str::random(10),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ];
    }
}
