<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyAccount;
use App\Notifications\VerifyAccountNotification;
use App\Profile;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('guest');
    }

    public function redirectTo()
    {
        return session('lang') . '/profile';
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'captcha' => 'captcha',
            'username' => 'required|max:255',
            'name' => 'nullable|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

//            profile fields
            'mobile_number' => 'required|max:11|unique:profiles',
//            'melli_code' => 'required|unique:profiles',
//            'gender' => 'required|boolean',
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
//        event(new Registered($user = $this->create($request->all())));

        $user = $this->create($request->all());
        Mail::to($user)->send(new VerifyAccount($user));

        return $this->registered()
            ?: redirect($this->redirectTo);
//        if you you need to print some variable's value or if it's empty some default text
    }

    protected function create(array $data)
    {
        try {
            $user = \DB::transaction(function () use ($data) {
                $verify_email_link = $this->generateVerifyAccountLink();

                $user = User::create([
                    'username' => $data['username'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'type' => 'user',
                    'is_admin' => 0,
                    'status' => 1,
                    'verified' => 0,
                    'access_level' => 1,
                    'password' => bcrypt($data['password']),
                    'verify_email_link' => $verify_email_link,
                ]);

                $profile = new Profile();
                $profile->mobile_number = $data['mobile_number'];
                $profile->melli_code = $data['melli_code'];
                $profile->gender = $data['gender'];
                $profile->user_id = $user->id;
                $profile->save();

                $user->profile = $profile;
                return $user;

            });
            return $user;

        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    protected function generateVerifyAccountLink()
    {
        $key = uniqid();
        return $key;
    }

    public function verifyAccount($verify_email_link)
    {
//        dd($verify_email_link);

        $user = User::where('verify_email_link', $verify_email_link)->first();

        if ($user) {
            $user->verified = 1;
            $user->verify_email_link = null;
            $user->save();
            $user->notify(new VerifyAccountNotification($user));
            Auth::loginUsingId($user->id);
//            return redirect('/dashboard');
            return redirect('/');
        }
        abort(404);
    }

    protected function registered()
    {
        return view('main_template.pages.message')->with([
            'type' => 'success',
            'title' => 'ثبت نام با موفقیت انجام شد.',
            'message' => 'ثبت نام شما با موفقیت انجام شد.لطفا جهت فعال سازی حسابتان به پست الکترونیکی خود مراجعه و بر روی لینک فعال سازی کلیک نمایید.'
        ]);

    }
}
