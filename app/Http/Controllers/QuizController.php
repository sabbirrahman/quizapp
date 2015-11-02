<?php namespace App\Http\Controllers;

use DateTime;
use App\Models\Quiz;
use App\Http\Requests\QuizRequest;
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
        $request['date_time'] = new DateTime($request['date_time']);
        Quiz::create($request->all());
    }

    public function show(Quiz $quiz)
    {
        return $quiz->toJson();
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $request['date_time'] = new DateTime($request['date_time']);
        $quiz->update($request->all());
    }
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
    }
}
