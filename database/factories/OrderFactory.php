<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(["pending","paid","filed"]),
            'total_amount' => fake()->randomFloat(0, 0, 9999999999.),
            'payment_method' => fake()->randomElement(["yookassa","coins"]),
            'payment_id' => fake()->word(),
            'user_id' => User::factory(),
        ];
    }
}
