<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginRequest extends Request {

    public function rules()
    {
        return [
            'log' => 'required', 'password' => 'required'
        ];
    }
}
