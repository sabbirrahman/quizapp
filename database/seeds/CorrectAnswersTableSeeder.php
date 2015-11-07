<?php

use App\Models\CorrectAnswer;
use Illuminate\Database\Seeder;

class CorrectAnswersTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table("correctanswers")->delete();
        CorrectAnswer::create([ 'question_id' =>  1, 'option_id' =>   2 ]);
        CorrectAnswer::create([ 'question_id' =>  2, 'option_id' =>   5 ]);
        CorrectAnswer::create([ 'question_id' =>  3, 'option_id' =>   9 ]);
        CorrectAnswer::create([ 'question_id' =>  4, 'option_id' =>  15 ]);
        CorrectAnswer::create([ 'question_id' =>  5, 'option_id' =>  19 ]);
        CorrectAnswer::create([ 'question_id' =>  6, 'option_id' =>  21 ]);
        CorrectAnswer::create([ 'question_id' =>  7, 'option_id' =>  25 ]);
        CorrectAnswer::create([ 'question_id' =>  8, 'option_id' =>  31 ]);
        CorrectAnswer::create([ 'question_id' =>  9, 'option_id' =>  35 ]);
        CorrectAnswer::create([ 'question_id' => 10, 'option_id' =>  37 ]);
        CorrectAnswer::create([ 'question_id' => 11, 'option_id' =>  43 ]);
        CorrectAnswer::create([ 'question_id' => 12, 'option_id' =>  46 ]);
        CorrectAnswer::create([ 'question_id' => 13, 'option_id' =>  50 ]);
        CorrectAnswer::create([ 'question_id' => 14, 'option_id' =>  53 ]);
        CorrectAnswer::create([ 'question_id' => 15, 'option_id' =>  57 ]);
        CorrectAnswer::create([ 'question_id' => 16, 'option_id' =>  63 ]);
        CorrectAnswer::create([ 'question_id' => 17, 'option_id' =>  67 ]);
        CorrectAnswer::create([ 'question_id' => 18, 'option_id' =>  70 ]);
        CorrectAnswer::create([ 'question_id' => 19, 'option_id' =>  73 ]);
        CorrectAnswer::create([ 'question_id' => 20, 'option_id' =>  78 ]);
        CorrectAnswer::create([ 'question_id' => 21, 'option_id' =>  82 ]);
        CorrectAnswer::create([ 'question_id' => 22, 'option_id' =>  88 ]);
        CorrectAnswer::create([ 'question_id' => 23, 'option_id' =>  92 ]);
        CorrectAnswer::create([ 'question_id' => 24, 'option_id' =>  96 ]);
        CorrectAnswer::create([ 'question_id' => 25, 'option_id' =>  98 ]);
        CorrectAnswer::create([ 'question_id' => 26, 'option_id' => 101 ]);
        CorrectAnswer::create([ 'question_id' => 27, 'option_id' => 106 ]);
        CorrectAnswer::create([ 'question_id' => 28, 'option_id' => 112 ]);
        CorrectAnswer::create([ 'question_id' => 29, 'option_id' => 113 ]);
        CorrectAnswer::create([ 'question_id' => 30, 'option_id' => 118 ]);
        CorrectAnswer::create([ 'question_id' => 31, 'option_id' => 122 ]);
        CorrectAnswer::create([ 'question_id' => 32, 'option_id' => 127 ]);
        CorrectAnswer::create([ 'question_id' => 33, 'option_id' => 132 ]);
        CorrectAnswer::create([ 'question_id' => 34, 'option_id' => 135 ]);
        CorrectAnswer::create([ 'question_id' => 35, 'option_id' => 138 ]);
        CorrectAnswer::create([ 'question_id' => 36, 'option_id' => 144 ]);
        CorrectAnswer::create([ 'question_id' => 37, 'option_id' => 147 ]);
        CorrectAnswer::create([ 'question_id' => 38, 'option_id' => 150 ]);
        CorrectAnswer::create([ 'question_id' => 39, 'option_id' => 155 ]);
        CorrectAnswer::create([ 'question_id' => 40, 'option_id' => 159 ]);
        CorrectAnswer::create([ 'question_id' => 41, 'option_id' => 164 ]);
        CorrectAnswer::create([ 'question_id' => 42, 'option_id' => 167 ]);
        CorrectAnswer::create([ 'question_id' => 43, 'option_id' => 172 ]);
        CorrectAnswer::create([ 'question_id' => 44, 'option_id' => 174 ]);
        CorrectAnswer::create([ 'question_id' => 45, 'option_id' => 179 ]);
        CorrectAnswer::create([ 'question_id' => 46, 'option_id' => 181 ]);
        CorrectAnswer::create([ 'question_id' => 47, 'option_id' => 185 ]);
        CorrectAnswer::create([ 'question_id' => 48, 'option_id' => 189 ]);
        CorrectAnswer::create([ 'question_id' => 49, 'option_id' => 193 ]);
        CorrectAnswer::create([ 'question_id' => 50, 'option_id' => 200 ]);
        
        CorrectAnswer::create([ 'question_id' => 51, 'option_id' => 201 ]);
        CorrectAnswer::create([ 'question_id' => 52, 'option_id' => 207 ]);
        CorrectAnswer::create([ 'question_id' => 53, 'option_id' => 210 ]);
        CorrectAnswer::create([ 'question_id' => 54, 'option_id' => 216 ]);
        CorrectAnswer::create([ 'question_id' => 55, 'option_id' => 218 ]);
        CorrectAnswer::create([ 'question_id' => 56, 'option_id' => 221 ]);

    }
}
