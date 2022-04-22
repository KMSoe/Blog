<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence,
            "description" => $this->faker->paragraph,
            "image" => $this->faker->imageUrl(),
            "category_id" => rand(1, 9),
            "user_id" => rand(1, 2),
        ];
    }
}
