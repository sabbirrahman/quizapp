<?php namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
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
            $question['options']        = $question->options()->get();
            $question['correct_answer'] = $question->correctAnswers()->first()->option()->first()->option;
        }

        return $questions;
    }

    public function store(Quiz $quiz, QuestionRequest $request)
    {
        Question::create($request->all());
    }

    public function show(Question $question)
    {
        return $question->toJson();
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $question::update($request->all());
    }
    
    public function destroy(Question $question)
    {
        $question->delete();
    }
}
