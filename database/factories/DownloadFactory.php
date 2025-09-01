<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Download;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DownloadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Download::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ip_address' => fake()->word(),
            'user_agent' => fake()->word(),
            'download_token' => fake()->word(),
            'expires_at' => fake()->dateTime(),
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
        ];
    }
}
