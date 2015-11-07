<?php namespace App\Http\Controllers;

use Auth;
use DateTime;
use App\Models\Quiz;
use App\Models\Option;
use App\Models\Question;
use App\Models\CorrectAnswer;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{

    public function index(Quiz $quiz)
    {
        $questions = Question::whereQuiz_id($quiz->id)->get();

        foreach($questions as $question) {
            $question['options'] = $question->options()->get();
            if($question->correctAnswers()->first() && Auth::user()->role == 'admin')
            $question['correct_answer'] = $question->correctAnswers()->first()->option()->first()->option;
        }

        // if(Auth::user()->role == 'student') {
        //     $quizDateTime = new DateTime($quiz->date_time);
        //     $currDateTime = new DateTime();
        //     if($currDateTime >= $quizDateTime) $questions;
        //     else return [];
        // }

        return $questions;
    }


    public function store(QuestionRequest $request)
    {
        $q = Question::create($request->all());
        $correct_answer_id;
        foreach($request['options'] as $option) {
            $o = Option::create([
                'option' => $option['option'],
                'question_id' => $q->id
            ]);
            if($request['correct_answer_id'] == $option['id']) {
                $correct_answer_id = $o->id;
            }
        }
        if($request['correct_answer_id']) {
            CorrectAnswer::create([
                'question_id' => $q->id,
                'option_id'   => $correct_answer_id
            ]);
        }
        return $q->toJson();
    }


    public function show(Quiz $quiz, Question $question)
    {
        $question['options'] = $question->options()->get();
        if($question->correctAnswers()->first())
        $question['correct_answer_id'] = $question->correctAnswers()->first()->option()->first()->id;
        return $question->toJson();
    }


    public function update(Quiz $quiz, Question $question, QuestionRequest $request)
    {
        if($request['correct_answer_id']) {
            $ca = CorrectAnswer::whereQuestionId($question->id)->first();
            if($ca) {
                $ca->update(['option_id' => $request['correct_answer_id']]);
            } else {
                CorrectAnswer::create([
                    'question_id' => $question->id,
                    'option_id'   => $request['correct_answer_id']
                ]);
            }
        }
        $question->update($request->all());
    }

    
    public function destroy(Quiz $quiz, Question $question)
    {
        $question->delete();
    }

}
