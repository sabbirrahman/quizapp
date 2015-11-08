<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => 'required | max:50',
            'email'      => 'required | email | unique:users,email,'.Request::get('user_id'),
            'student_id' => 'required | max:15 | unique:students,student_id,'.Request::get('id'),
            'batch'      => 'required | numeric',
            'department' => 'required | max:50'
        ];
    }
}
