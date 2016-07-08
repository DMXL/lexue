<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords {
        ResetsPasswords::showResetForm as showResetFormForToken;
    }

    protected $broker;

    protected $linkRequestView = 'app/auth/passwords/email';

    protected $resetView = 'app/auth/passwords/reset';

    /**
     * Create a new password controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->broker = userType();
    }

    /**
     * Properly getting the token parameter first before passing it on
     *
     * @param  \Illuminate\Http\Request $request
     * @param string $userType
     * @param  string|null $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $userType, $token = null)
    {
        return $this->showResetFormForToken($request, $token);
    }
}
