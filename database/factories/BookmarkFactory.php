<?php

namespace Database\Factories;

use App\Models\Bookmark;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bookmark>
 */
class BookmarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => fake()->sentence(3),
            'url' => fake()->url(),
            'description' => fake()->optional()->paragraph(),
            'is_favorite' => fake()->boolean(),
            'read_later' => fake()->boolean(),
        ];
    }
}
