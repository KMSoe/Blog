<?php

namespace Database\Seeders;

use App\Models\Reaction;
use Illuminate\Database\Seeder;

class ReactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reactions = [
            ["user_id" => 1, "post_id" => 1, "type" => "like"],
            ["user_id" => 2, "post_id" => 1, "type" => "unlike"],
            ["user_id" => 3, "post_id" => 1, "type" => "love"],
            ["user_id" => 4, "post_id" => 1, "type" => "wow"],
        ];

        foreach ($reactions as $reaction) {
            Reaction::create($reaction);
        }
    }
}
