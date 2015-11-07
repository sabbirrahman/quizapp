<?php namespace App\Http\Controllers;

use DB;
use Auth;
use DateTime;
use App\Models\Quiz;
use App\Models\Student;
use App\Http\Requests\QuizRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{

    public function index()
    {
        if(Auth::user()->role == 'student') {
            $quizzes = Quiz::all();
            foreach($quizzes as $quiz) {
                $quiz['participated'] = Auth::user()->student()->first()->quizzes()->get()->find($quiz->id) ? true : false;
            }
            return $quizzes->toJson();
        }
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
    
    public function participants(Quiz $quiz) {
        $participants = $quiz->participants()->get();
        foreach ($participants as $participant) {
            $participant['name' ] = $participant->user()->first()->name;
            $participant['score'] = $participant->scores()->whereQuizId($quiz->id)->first()->score;
            $participant['time' ] = $participant->scores()->whereQuizId($quiz->id)->first()->time;
        }
        return $participants;
    }



    public function participate(Quiz $quiz, Student $student) {
        if(new DateTime($quiz->date_time) < new DateTime) return;
        $r = DB::table('quiz_student')->whereStudentIdAndQuizId($student->id, $quiz->id)->first();
        if($r) {
            DB::table('quiz_student')->whereStudentIdAndQuizId($student->id, $quiz->id)->delete();
            return 0;
        } else {
            DB::table('quiz_student')->insert([
                'student_id' => $student->id,
                'quiz_id'    => $quiz->id
            ]);
            return 1;
        }
    }
}
