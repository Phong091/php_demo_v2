<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookImport>
 */
class BookImportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $totalQuantity = fake()->numberBetween(10, 100);
        $averageCost = fake()->randomFloat(2, 30000, 200000);
        $totalCost = $totalQuantity * $averageCost;

        return [
            'import_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'total_quantity' => $totalQuantity,
            'total_cost' => $totalCost,
            'notes' => fake()->optional()->sentence(),
            'imported_by' => User::factory(),
        ];
    }

    /**
     * Indicate that the import is recent.
     */
    public function recent(): static
    {
        return $this->state(fn (array $attributes) => [
            'import_date' => fake()->dateTimeBetween('-30 days', 'now'),
        ]);
    }
}

