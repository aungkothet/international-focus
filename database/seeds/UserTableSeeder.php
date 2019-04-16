<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => "Admin",
                'email' => "admin@gmail.com",
                'password' => bcrypt('admin')
            ],
            [
                'name' => "Moderator",
                'email' => "moderator@gmail.com",
                'password' => bcrypt('moderator')
            ]
        ]);
    }
}
