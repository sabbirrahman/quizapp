<?php namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Http\Request\QuizRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{

    public function index()
    {
        return Quiz::all()->toJson();        
    }

    public function store(QuizRequest $request)
    {
        Quiz::create($request->all());
    }

    public function show(Quiz $quiz)
    {
        return $quiz->toJson();
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $quiz::update($request->all());
    }
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
    }
}
