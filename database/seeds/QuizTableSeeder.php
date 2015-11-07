<?php

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizzesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('quizzes')->delete();

        Quiz::create([
            'title'       => 'Quiz Contest 2013',
            'date_time'   => new DateTime('2013-03-15 11:00 GMT'),
            'duration'    => 50,
            'description' => 'UU ICT CLUB Foundation Festival Quiz Contest 2013'
        ]);

        Quiz::create([
    		'title'       => 'ICT Quiz 2015',
    		'date_time'   => new DateTime('2015-11-01 13:00 GMT'),
    		'duration'    => 120,
    		'description' => 'First Test Quiz'
        ]);

        Quiz::create([
    		'title'       => 'Science Quiz 2015',
    		'date_time'   => new DateTime('2015-11-05 14:00 GMT'),
    		'duration'    => 60,
    		'description' => 'Second Test Quiz'
        ]);

        Quiz::create([
    		'title'       => 'Technology Quiz 2015',
    		'date_time'   => new DateTime('2015-11-11 11:00 GMT'),
    		'duration'    => 180,
    		'description' => 'Third Test Quiz'
        ]);

        $participants = array(
            [ "quiz_id" => 2, "student_id" => 1],
            [ "quiz_id" => 2, "student_id" => 2],
            [ "quiz_id" => 3, "student_id" => 3],
            [ "quiz_id" => 3, "student_id" => 1],
            [ "quiz_id" => 4, "student_id" => 2],
            [ "quiz_id" => 4, "student_id" => 3],
        );

        DB::table('quiz_student')->insert($participants);
    }
}
