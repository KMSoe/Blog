<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ["name" => "Alice", "email" => "alice@gmail.com", "password" => bcrypt("111111")],
            ["name" => "Bob", "email" => "bob@gmail.com", "password" => bcrypt("111111")],
            ["name" => "John", "email" => "john@gmail.com", "password" => bcrypt("111111")],
            ["name" => "Sue", "email" => "sue@gmail.com", "password" => bcrypt("111111")],
        ];
        
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
