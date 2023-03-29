<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->sentence(mt_rand(2,8)),
            "thumbnail" => $this->faker->imageUrl(1080, 1080, 'post', true),
            "body" => $this->faker->paragraphs(5, true),
            "active" => $this->faker->boolean(),
            "published_at" => $this->faker->dateTime(),
            "user_id" => 1,
        ];
    }
}
