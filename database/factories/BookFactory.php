<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'category' => $this->faker->randomElement(['UKOM Keperawatan', 'UKOM Bidan', 'Lainnya']),
            'excerpt' => $this->faker->sentence(8),
            'description' => $this->faker->paragraph(3),
            'price' => 'Rp ' . $this->faker->numberBetween(100000, 300000),
            'cover_image' => 'books/default.png',
        ];
    }
}
