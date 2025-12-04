<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookImport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookImportItem>
 */
class BookImportItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 50);
        $unitCost = fake()->randomFloat(2, 20000, 150000);
        $totalCost = $quantity * $unitCost;

        return [
            'book_import_id' => BookImport::factory(),
            'book_id' => Book::factory(),
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'total_cost' => $totalCost,
        ];
    }
}

