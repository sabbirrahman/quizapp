<?php namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Http\Requests\OptionRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{

    public function store(OptionRequest $request)
    {
        return Option::create($request->all());
    }
    
    public function update(Question $question, Option $option, OptionRequest $request)
    {
        $option->update($request->all());
    }

    public function destroy(Question $question, Option $option)
    {
        $option->delete();
    }
}
