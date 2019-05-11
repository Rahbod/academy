<?php

namespace Appnegar\Cms\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
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
    protected $redirectTo;


    public function showLoginForm()
    {
        $route='admin.login';
        return view('appnegar::login',['route'=>$route]);
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $this->setLoginActivity();
            $this->setRedirectTo();
//            dd($this->setRedirectTo(),$this->guard());
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials=$request->only($this->username(), 'password');
        return array_merge($credentials, ['status' => 1,'is_admin'=>1]);
    }

    public function logout(Request $request)
    {
        $redirect_to=$this->setRedirectTo().'login';
        $this->setLogoutActivity();

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect($redirect_to);
    }

    public function setRedirectTo()
    {
        $params=request()->route()->parameters();

        if(isset($params['department']) and $params['department'] !== 'profile')
        {
            $this->redirectTo=session('lang').'/'.$params['department'].'/';
        }
        else
        {
            $this->redirectTo=session('lang').'/profile';
        }
        return $this->redirectTo;
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        $department=session('department');
        if($department !== 'profile'){
            return \Auth::guard(session('department'));
        }
       return \Auth::guard();
    }

    protected function setLoginActivity(){
        activity('login')
            ->causedBy($this->guard()->user())
            ->log('');
    }

    protected function setLogoutActivity(){
        activity('logout')
            ->causedBy($this->guard()->user())
            ->log('');
    }
}
