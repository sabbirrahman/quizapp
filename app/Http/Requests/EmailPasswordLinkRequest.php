<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class EmailPasswordLinkRequest extends Request {

    public function rules()
    {
        return [
            'email' => 'required',
        ];
    }
}
