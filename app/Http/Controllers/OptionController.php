<?php namespace App\Http\Conrollers;

use App\Models\Option;
use App\Models\Request\OptionRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{

    public function index()
    {
        return Option::all()->toJson();        
    }

    public function store(OptionRequest $request)
    {
        Option::create($request->all());
    }

    public function show(Option $option)
    {
        return $option->toJson();
    }

    public function update(OptionRequest $request, Option $option)
    {
        $option::update($request->all());
    }
    public function destroy(Option $option)
    {
        $option->delete();
    }
}
