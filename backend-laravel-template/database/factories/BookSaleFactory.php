<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookSale>
 */
class BookSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sale_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'total_amount' => fake()->randomFloat(2, 50000, 2000000),
            'customer_name' => fake()->optional()->name(),
            'customer_email' => fake()->optional()->safeEmail(),
            'customer_phone' => fake()->optional()->phoneNumber(),
            'notes' => fake()->optional()->sentence(),
            'sold_by' => User::factory(),
        ];
    }

    /**
     * Indicate that the sale is recent.
     */
    public function recent(): static
    {
        return $this->state(fn (array $attributes) => [
            'sale_date' => fake()->dateTimeBetween('-30 days', 'now'),
        ]);
    }

    /**
     * Indicate that the sale has customer information.
     */
    public function withCustomer(): static
    {
        return $this->state(fn (array $attributes) => [
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
        ]);
    }
}

