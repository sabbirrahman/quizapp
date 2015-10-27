<?php namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Request\QuestionRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{

    public function index()
    {
        return Question::all()->toJson();        
    }

    public function store(QuestionRequest $request)
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
