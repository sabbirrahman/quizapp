<?php

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizzesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('quizzes')->delete();

        Quiz::create([
    		'id'          => 1,
    		'title'       => 'ICT Quiz 2015',
    		'date_time'   => new DateTime('2015-11-01 13:00 GMT'),
    		'duration'    => 2,
    		'description' => 'First Test Quiz'
        ]);

        Quiz::create([
    		'id'          => 2,
    		'title'       => 'Science Quiz 2015',
    		'date_time'   => new DateTime('2015-11-05 14:00 GMT'),
    		'duration'    => 1,
    		'description' => 'Second Test Quiz'
        ]);

        Quiz::create([
    		'id'          => 3,
    		'title'       => 'Technology Quiz 2015',
    		'date_time'   => new DateTime('2015-11-11 11:00 GMT'),
    		'duration'    => 3,
    		'description' => 'Third Test Quiz'
        ]);

        $participants = array(
            [ "quiz_id" => 1, "student_id" => 1],
            [ "quiz_id" => 1, "student_id" => 2],
            [ "quiz_id" => 2, "student_id" => 3],
            [ "quiz_id" => 2, "student_id" => 1],
            [ "quiz_id" => 3, "student_id" => 2],
            [ "quiz_id" => 3, "student_id" => 3],
        );

        DB::table('quiz_student')->insert($participants);
    }
}
