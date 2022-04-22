<?php

namespace Database\Seeders;

use App\Models\Reaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        $this->call(UsersSeeder::class);

        \App\Models\Category::factory(10)->create();
        \App\Models\Post::factory(30)->create();
        \App\Models\Comment::factory(30)->create();

        $this->call(ReactionsSeeder::class);
    }
}
