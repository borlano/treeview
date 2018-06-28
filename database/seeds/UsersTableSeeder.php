<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Create new user.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'login' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('123123')
        ]);
    }
}