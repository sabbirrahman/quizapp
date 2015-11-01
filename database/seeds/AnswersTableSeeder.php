<?php

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table('answers')->delete();

    	Answer::create(['student_id' => 1, 'question_id' => 1, 'option_id'=>  1 ]);
    	Answer::create(['student_id' => 1, 'question_id' => 3, 'option_id'=>  9 ]);
    	Answer::create(['student_id' => 1, 'question_id' => 4, 'option_id'=> 16 ]);
    	Answer::create(['student_id' => 1, 'question_id' => 5, 'option_id'=> 19 ]);
    	Answer::create(['student_id' => 2, 'question_id' => 1, 'option_id'=>  1 ]);
    	Answer::create(['student_id' => 2, 'question_id' => 2, 'option_id'=>  5 ]);
    	Answer::create(['student_id' => 2, 'question_id' => 3, 'option_id'=> 10 ]);
    	Answer::create(['student_id' => 2, 'question_id' => 6, 'option_id'=> 23 ]);
    	Answer::create(['student_id' => 3, 'question_id' => 2, 'option_id'=>  7 ]);
    	Answer::create(['student_id' => 3, 'question_id' => 4, 'option_id'=> 14 ]);
    	Answer::create(['student_id' => 3, 'question_id' => 5, 'option_id'=> 18 ]);
    	Answer::create(['student_id' => 3, 'question_id' => 6, 'option_id'=> 24 ]);
    }
}
