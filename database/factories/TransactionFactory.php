<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Balance;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(["deposit","withdraw","purchase","refund"]),
            'status' => fake()->randomElement(["pending","completed","failed"]),
            'amount' => fake()->randomFloat(0, 0, 9999999999.),
            'description' => fake()->text(),
            'user_id' => User::factory(),
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'balance_id' => Balance::factory(),
        ];
    }
}
