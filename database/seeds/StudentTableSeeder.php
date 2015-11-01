<?php

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->delete();

        Student::create([
            'student_id' => 'M21132111002',
            'batch' 	 => '25',
            'department' => 'Sabbir Rahman',
            'user_id'    => '2'
        ]);

        Student::create([
            'student_id' => 'M21132111009',
            'batch'      => '27',
            'department' => 'Joynal Abedin',
            'user_id'    => '3'
        ]);

        Student::create([
            'student_id' => 'F21132111004',
            'batch'      => '26',
            'department' => 'Shaika Sayed Marzia',
            'user_id'    => '4'
        ]);
    }
}
