<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller {

    public function index()
    {
        return "From index";
//        return view('index');
    }

    public function admin()
    {
        return "From admin panel";
//        return view('admin.dashboard');
    }

    public function student()
    {
        return "From student panel";
//        return view('student.dashboard');
    }
}
