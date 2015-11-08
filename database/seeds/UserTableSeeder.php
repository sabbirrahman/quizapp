<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

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
            'email'    => 'sabbir@gmail.com',
            'username' => 'sabbir',
            'name'     => 'Sabbir Rahman',
            'role'     => 'student',
            'password' => bcrypt('sabbir'),
        ]);

        User::create([
            'email'    => 'joynal@gmail.com',
            'username' => 'joynal',
            'name'     => 'Joynal Abedin',
            'role'     => 'student',
            'password' => bcrypt('joy'),
        ]);

        User::create([
            'email'    => 'mehedi@gmail.com',
            'username' => 'mehedi',
            'name'     => 'Mehedi Hasan Bhuiyan',
            'role'     => 'student',
            'password' => bcrypt('mehedi'),
        ]);
    }
}
