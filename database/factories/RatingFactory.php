<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'review' => $this->faker->paragraph,
            'rating' => $this->faker->numberBetween(0, 5),
            'user_id' => function() {
                return User::all()->random();
            },
            'book_id' => function() {
                return Book::all()->random();
            },
        ];
    }
}
