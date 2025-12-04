<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookSale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookSaleItem>
 */
class BookSaleItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 10);
        $unitPrice = fake()->randomFloat(2, 50000, 500000);
        $totalPrice = $quantity * $unitPrice;

        return [
            'book_sale_id' => BookSale::factory(),
            'book_id' => Book::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
        ];
    }
}

