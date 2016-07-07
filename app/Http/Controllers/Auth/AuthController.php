<?php

namespace App\Http\Controllers\Auth;

use App\Models\Users\Admin;
use App\Models\Users\Student;
use App\Models\Users\Teacher;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Which user model to authenticate
     *
     * @var string
     */
    private $guard;

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);

        $this->guard = \Request::route('user_type');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:'.$this->guard,
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * TODO consider refactoring the user type checking if also needed elsewhere
     *
     * @param  array  $data
     * @return Teacher|Student|Admin
     */
    protected function create(array $data)
    {
        if ($this->guard === 'teachers') {
            $user = new Teacher();
        } elseif ($this->guard === 'students') {
            $user = new Student();
        } elseif ($this->guard === 'admins') {
            $user = new Admin();
        }

        if (isset($user)) {
            $user = $this->setUserData($user, $data);
            $user->save();
            return $user;
        }

        return null;
    }

    /**
     * Set attributes manually due to mass assignment constraints
     *
     * @param $user
     * @param array $data
     * @return Student|Teacher|Admin
     */
    private function setUserData($user, array $data)
    {
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        return $user;
    }
}
