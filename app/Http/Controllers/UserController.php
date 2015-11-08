<?php namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(User $user)
    {
        return $user->toJson();
    }


    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
    }


    public function updatePassword(User $user, PasswordRequest $request)
    {
        extract($request->all());
        if(Hash::check($old_password, $user->password)) {
            $user->password = bcrypt($new_password);
            $user->save();
            return "true";
        } else {
            return "false";
        }
    }
}
