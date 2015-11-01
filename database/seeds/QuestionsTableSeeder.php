<?php

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table("questions")->delete();

    	Question::create([
			'question' => 'A for?',
			'quiz_id'  => 1
    	]);

    	Question::create([
			'question' => 'B for?',
			'quiz_id'  => 3
    	]);

    	Question::create([
			'question' => 'C for?',
			'quiz_id'  => 1
    	]);

    	Question::create([
    		'question' => 'D for?',
    		'quiz_id'  => 2
    	]);

    	Question::create([
    		'question' => 'E for?',
    		'quiz_id'  => 2
    	]);

    	Question::create([
    		'question' => 'F for?',
    		'quiz_id'  => 3
    	]);
    }
}
