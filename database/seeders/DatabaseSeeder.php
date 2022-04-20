<?php

namespace Database\Seeders;

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

        User::create([
            "name" => "Alice",
            "email" => "alice@gmail.com",
            "password" => bcrypt("111111"),
        ]);

        User::create([
            "name" => "Bob",
            "email" => "bob@gmail.com",
            "password" => bcrypt("111111"),
        ]);

        \App\Models\Category::factory(10)->create();
        \App\Models\Post::factory(30)->create();
        \App\Models\Comment::factory(15)->create();
    }
}
