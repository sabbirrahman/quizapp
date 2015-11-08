<?php namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        foreach($students as $student) {
            $user = $student->user()->first();
            $student['name' ] = $user->name;
            $student['email'] = $user->email;
        }
        return $students;
    }

    public function store(StudentRequest $request)
    {
        Student::create($request->all());
    }

    public function show(Student $student)
    {
        $user = $student->user()->first();
        $student['name' ] = $user->name;
        $student['email'] = $user->email;
        return $student->toJson();
    }

    public function update(StudentRequest $request, Student $student)
    {
        $user = $student->user()->first();
        $student->update($request->all());
        $user->update($request->all());
    }

    public function destroy(Student $student)
    {
        $student->delete();
    }

    public function quizzes(Student $student) {
        $quizzes = $student->quizzes()->get();
        foreach($quizzes as $quiz) {
            $quiz['score'] = $student->scores()->whereQuizId($quiz->id)->first()->score;
            $quiz['time' ] = $student->scores()->whereQuizId($quiz->id)->first()->time;
        }
        return $quizzes->toJson();
    }

    public function score(Student $student, Quiz $quiz) {
        return $student->scores()->whereQuizId($quiz->id)->first()->toJson();
    }

}
