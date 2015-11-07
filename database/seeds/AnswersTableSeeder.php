<?php

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table('answers')->delete();

    	Answer::create(['student_id' => 1, 'question_id' => 51, 'option_id'=> 201 ]);
    	Answer::create(['student_id' => 1, 'question_id' => 53, 'option_id'=> 209 ]);
    	Answer::create(['student_id' => 1, 'question_id' => 54, 'option_id'=> 216 ]);
    	Answer::create(['student_id' => 1, 'question_id' => 55, 'option_id'=> 219 ]);
    	Answer::create(['student_id' => 2, 'question_id' => 51, 'option_id'=> 201 ]);
    	Answer::create(['student_id' => 2, 'question_id' => 52, 'option_id'=> 205 ]);
    	Answer::create(['student_id' => 2, 'question_id' => 53, 'option_id'=> 210 ]);
    	Answer::create(['student_id' => 2, 'question_id' => 56, 'option_id'=> 223 ]);
    	Answer::create(['student_id' => 3, 'question_id' => 52, 'option_id'=> 207 ]);
    	Answer::create(['student_id' => 3, 'question_id' => 54, 'option_id'=> 214 ]);
    	Answer::create(['student_id' => 3, 'question_id' => 55, 'option_id'=> 218 ]);
    	Answer::create(['student_id' => 3, 'question_id' => 56, 'option_id'=> 224 ]);
    }
}
