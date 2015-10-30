<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request {

    public function rules()
    {
        return [
            'username' => 'required|max:30|alpha|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'name'     => 'require|max:60'
        ];
    }
}
