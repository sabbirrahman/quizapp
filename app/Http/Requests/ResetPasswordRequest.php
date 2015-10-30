<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class ResetPasswordRequest extends Request {

    public function rules()
    {
        return [
            'token'    => 'required',
            'email'    => 'required',
            'password' => 'required|min:8|confirmed',
        ];
    }
}
