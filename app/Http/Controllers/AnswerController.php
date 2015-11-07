<?php namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Quiz;
use App\Models\Score;
use App\Models\Answer;
use App\Models\CorrectAnswer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    public function index(Quiz $quiz)
    {
        $student = Auth::user()->student()->first();
        $questions = $quiz->questions()->get();
        foreach($questions as $question) {
            $question['answer'] = $question->answers()->whereStudentId($student->id)->first()->option()->first()->option;
            $question['correct_answer'] = $question->correctanswers()->first()->option()->first()->option;
        }
        return $questions->toJson();
    }

    public function store(Quiz $quiz, Request $request)
    {
        $student_id = Auth::user()->student()->first()->id;
        if(Score::whereQuizIdAndStudentId($quiz->id, $student_id)) return "e";
        $points = 0;
        foreach ($request->all() as $r) {
            $ca = CorrectAnswer::whereQuestionId($r['question_id'])->first()->option_id;
            if($ca == $r['option_id']) $points++;
            if(!Answer::whereStudentIdAndQuestionId($student_id, $r['question_id'])->first()) {
                Answer::create([
                    'student_id'  => $student_id,
                    'question_id' => $r['question_id'],
                    'option_id'   => $r['option_id']
                ]);
            }
        }
        $score = Score::create([
            'score'      => $points,
            'time'       => time() - strtotime($quiz->date_time),
            'quiz_id'    => $quiz->id,
            'student_id' => $student_id
        ]);
        DB::table('quiz_student')->insert([
            'student_id' => $student_id,
            'quiz_id'    => $quiz->id
        ]);
        return $score;
    }

    public function correctAnswers(Quiz $quiz) {
        $questions = $quiz->questions()->get();
        $correctanswers = [];
        foreach($questions as $question) {
            $correctanswers[] = $question->correctAnswers()->first()->option()->first();
        }
        return $correctanswers;
    }
}
