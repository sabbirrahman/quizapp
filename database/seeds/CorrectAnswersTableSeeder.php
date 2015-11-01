<?php

use App\Models\CorrectAnswer;
use Illuminate\Database\Seeder;

class CorrectAnswersTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table("correctanswers")->delete();
        
        CorrectAnswer::create([ 'question_id' => '1', 'option_id' =>  '1' ]);
        CorrectAnswer::create([ 'question_id' => '2', 'option_id' =>  '7' ]);
        CorrectAnswer::create([ 'question_id' => '3', 'option_id' => '10' ]);
        CorrectAnswer::create([ 'question_id' => '4', 'option_id' => '16' ]);
        CorrectAnswer::create([ 'question_id' => '5', 'option_id' => '18' ]);
        CorrectAnswer::create([ 'question_id' => '6', 'option_id' => '21' ]);

    }
}
