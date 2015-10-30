<?php namespace App\Http\Controllers\Auth;

use Validator;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller {

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected $redirectPath = '/student';

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:60',
            'username' => 'required|max:30|alpha|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'role'     => 'student'
        ]);
    }

    public function getLogin()
    {
        return view('auth.login');
    }


    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'log' => 'required', 'password' => 'required',
        ]);

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request))
        {
            return $this->sendLockoutResponse($request);
        }

        $logValue = $request->input('log');

        $logAccess = filter_var($logValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $logAccess => $logValue,
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials, $request->has('remember')))
        {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        if ($throttles)
        {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only('log', 'remember'))
            ->withErrors([
                'log' => $this->getFailedLoginMessage(),
            ]);
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles)
        {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated'))
        {
            return $this->authenticated($request, Auth::user());
        }

        if (Auth::user()->role === 'admin')
        {
            return redirect()->intended('admin');
        }

        return redirect()->intended($this->redirectPath());
    }


    public function getRegister()
    {
        return view('auth.register');
    }


    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::login($this->create($request->all()));

        return redirect($this->redirectPath());
    }
}
