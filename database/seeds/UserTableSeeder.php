<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'email'    => 'admin@quizapp.io',
            'username' => 'admin',
            'name'     => 'Super Admin',
            'role'     => 'admin',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'email'    => 'joynal@gmail.com',
            'username' => 'joynal',
            'name'     => 'Joynal Abedin',
            'role'     => 'student',
            'password' => bcrypt('12345'),
        ]);
    }
}
