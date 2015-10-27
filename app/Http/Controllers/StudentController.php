<?php namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Request\StudentRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{

    public function index()
    {
        return Student::all()->toJson();
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
}
