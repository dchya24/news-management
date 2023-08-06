<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(10);
        $slug = Str::slug($title, '-') . '-' . fake()->unixTime('now');
        return [
            "title" => $title,
            "slug" => $slug,
            'user_id' => 1,
            "content" => fake()->text(),
            "image" => fake()->imageUrl(),
            "created_at" => now(),
        ];
    }
}
