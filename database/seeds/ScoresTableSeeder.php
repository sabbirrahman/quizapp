<?php

use App\Models\Score;
use Illuminate\Database\Seeder;

class ScoresTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table('scores')->delete();

    	Score::create(['score' => 1, 'quiz_id' => 1, 'student_id' => 1]);
    	Score::create(['score' => 1, 'quiz_id' => 2, 'student_id' => 1]);
    	Score::create(['score' => 2, 'quiz_id' => 1, 'student_id' => 2]);
    	Score::create(['score' => 0, 'quiz_id' => 3, 'student_id' => 2]);
    	Score::create(['score' => 1, 'quiz_id' => 2, 'student_id' => 3]);
    	Score::create(['score' => 1, 'quiz_id' => 3, 'student_id' => 3]);
    }
}
