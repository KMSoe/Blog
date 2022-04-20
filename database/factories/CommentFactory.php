<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "comment_text" => $this->faker->word,
            "post_id" => rand(1, 9),
            "user_id" => rand(1, 2),
        ];
    }
}
