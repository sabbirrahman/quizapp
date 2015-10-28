<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'email' => 'admin@quizapp.io',
            'role'  => 'admin',
            'password' => bcrypt('quizapp'),
            'remember_token' => bcrypt('quizapp')
        ]);
    }
}
