<?php namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Student;
use App\Models\Question;
use App\Http\Request\StudentRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        foreach($students as $student) {
            $u = $student->user()->first();
            $student['name' ] = $u->name;
            $student['email'] = $u->email;
        }
        return $students;
    }

    public function store(StudentRequest $request)
    {
        Student::create($request->all());
    }

    public function show(Student $student)
    {
        return $student->toJson();
    }

    public function update(StudentRequest $request, Student $student)
    {
        $student::update($request->all());
    }

    public function destroy(Student $student)
    {
        $student->delete();
    }

    public function postStudentAnswers(Request $request) {
        $student_id = Auth::user()->student()->first()->id;
        $score = 0;
        foreach ($request->all() as $r) {
            $ca = Question::find($r['question_id'])->first()->correctAnswers()->first()->option_id;
            if($ca == $r['option_id']) $score++;
            if(!Answer::whereStudentIdAndQuestionId($student_id, $r['question_id'])->first()) {
                Answer::create([
                    'student_id'  => $student_id,
                    'question_id' => $r['question_id'],
                    'option_id'   => $r['option_id']
                ]);
            }
        }
        return $score;
    }

    public function getStudentAnswers(Quiz $quiz) {
        $student = Auth::user()->student()->first();
        $questions = $quiz->questions()->get();
        foreach($questions as $question) {
            $question['answer'] = $question->answers()->whereStudentId($student->id)->first()->option()->first()->option;
            $question['correct_answer'] = $question->correctanswers()->first()->option()->first()->option;
        }
        return $questions->toJson();
    }

    public function participate(Quiz $quiz) {
        $student_id = Auth::user()->student()->first()->id;
        $r = DB::table('quiz_student')->whereStudentIdAndQuizId($student_id, $quiz->id)->first();
        if($r) {
            DB::table('quiz_student')->whereStudentIdAndQuizId($student_id, $quiz->id)->delete();
            return 0;
        } else {
            DB::table('quiz_student')->insert([
                'student_id' => $student_id,
                'quiz_id'    => $quiz->id
            ]);
            return 1;
        }
    }

    public function studentQuizzes(Student $student) {
        $myquizzes = $student->quizzes()->get();
        foreach($myquizzes as $quiz) {
            $quiz['score'] = $student->scores()->whereQuizId($quiz->id)->first()->score;
            $quiz['time' ] = $student->scores()->whereQuizId($quiz->id)->first()->time;
        }
        return $myquizzes->toJson();
    }

    public function studentScore(Quiz $quiz) {
        $student = Auth::user()->student()->first();
        return $student->scores()->whereQuizId($quiz->id)->first()->toJson();
    }
}
