<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $maxLoginAttempts = 2;
    protected $lockoutTime = 300;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        return session('lang') . '/profile';
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->verified) {
            if ($redirect = session('redirect')) {
                session(['redirect' => null]);
                return redirect()->intended($redirect);
            }
            return redirect()->intended($this->redirectPath());
        }
        $this->logout($request);
        return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
    }
}
