<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Balance;
use App\Models\Transaction;
use App\Models\User;

class BalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Balance::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(0, 0, 9999999999.),
            'currency' => fake()->word(),
            'user_id' => User::factory(),
            'transaction_id' => Transaction::factory(),
        ];
    }
}
