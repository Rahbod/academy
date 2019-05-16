<?php

namespace Appnegar\Cms\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class AdminProfileController extends AdminController
{

    public $config;

    public function __construct()
    {
        $this->resource = 'User';
        $config = config('system.user');
        $this->config = [
            'user' => [
                'avatar' => [
                    'size' => $config['avatar_size'],
                    'width' => $config['avatar_width'],
                    'height' => $config['avatar_height'],
                    'extension' => $config['avatar_extension'],
                    'destination' => $config['avatar_destination'],
                ]
            ]
        ];
    }

    public function updateBasicInfo(Request $request)
    {
        $user = $this->getUser();
        $request_data = $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,id,' . $user->id,
            'email' => 'required|email|unique:users,id,' . $user->id,
            'avatar' => 'nullable|image|max:' . $this->config['user']['avatar']['size'] . '|mimes:' . trimArrayString($this->config['user']['avatar']['extension']),
            'profile.gender' => 'required|numeric|between:0,1',
            'profile.birthday' => 'nullable'
        ]);

        return $this->updateModel($request_data);
    }

    public function updatePersonalInfo (Request $request)
    {
        $user = $this->getUser();
        $request_data = $this->validate($request, [
            'email' => 'required|email|unique:users,id,' . $user->id,
            'profile.mobile_number' => 'nullable',
            'profile.address' => 'nullable',
            'profile.postal_code' => 'nullable',
            'profile.melli_code' => 'nullable',
            'profile.grade' => 'nullable',
            'profile.city' => 'nullable',
        ]);

        return $this->updateModel($request_data);
    }

    public function updateAboutUser(Request $request)
    {
        $request_data = $this->validate($request, [
            'profile.description' => 'nullable'
        ]);

        return $this->updateModel($request_data);
    }


    public function updatePassword(Request $request)
    {
        $request_data = $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);

        return $this->updateModel($request_data);
    }

    protected function getUserRequest($request_data)
    {
        $result = [];
        foreach ($request_data as $key => $value) {
            if ($key !== 'profile') {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    protected function getProfileRequest($request_data)
    {
        $result = [];
        if (isset($request_data['profile']))
            foreach ($request_data['profile'] as $key => $value) {
                $result[$key] = $value;
            }
        return $result;
    }


    protected function updateModel($request)
    {
        try {
            $status = \DB::transaction(function () use ($request) {
                $user_status=$this->updateUser($this->getUserRequest($request));
                $profile_status = $this->updateProfile($this->getProfileRequest($request));
                return ($user_status || $profile_status);
            });
            if ($status) {
                setUserSession(true);
                $resource = __('profiles.title');
                $action = __('main.actions.edit');

                if ($status) {
                    $user = $this->getUserSession();
                    return response()->json([
                        'message' => __('main.messages.action_success', ['resource' => $resource, 'action' => $action]),
                        'model' => $user
                    ]);
                }
            } else {
                return $this->getResponseMessage($status, $this->resource, 'edit');
            }

        } catch (\Exception $e) {
            return response(['errors' => $e->getMessage(), 'message' => 'error!'], 500);
//            throw $e;
        }
    }

    protected function updateUser($request)
    {
        $status = true;
        if (count($request) > 0) {
            $user = $this->getUser();
            if (request()->exists('avatar_src')) {
                $delete_file_status = (request()->avatar_src == null);
                $avatar_name = null;
                if (isset($request['avatar'])) {
                    $image_status = $this->saveImage($request['avatar'], $this->config['user']['avatar']);
                    if ($image_status['status'] == false) {
                        $errors = explode(', ', $image_status['data']);
                        throw new \Exception($errors);
                    } else {
                        $avatar_name = $image_status['data'];
                        $delete_file_status = true;
                    }
                }
                if ($delete_file_status) {
                    $this->deleteFile($user->avatar);
                    $user->avatar = $avatar_name;
                }
            }

        foreach ($request as $key => $value) {
            if ($key == 'password') {
                if (!$value) {
                    continue;
                }
                $user->$key = bcrypt($value);
            } else if ($key !== 'avatar') {
                $user->$key = $value;
            }


        }
        $status = $user->save();
    }
return $status;
}

protected function updateProfile($request)
{
    $status = false;
    if (count($request) > 0) {
        $user = $this->getUser();

        $model = Profile::where('user_id', $user->id)->first();
        if (!$model) {
            $model = new Profile();
            $model->user_id = $user->id;
        }

        foreach ($request as $key => $value) {
            $model->$key = $value;
        }
        $status = $model->save();
    }
    return $status;
}

protected function getUser()
{
    if (session('department') and session('department') !== 'profile') {
        $user = \Auth::guard(session('department'))->user();
    } else {
        $user = \Auth::user();
    }

    return $user;
}

protected function getUserSession()
{
    $session_key = 'user_info';
    if (session('department') !== null and session('department') !== 'profile') {
        $session_key = 'user_info_' . session('department');
    }
    return session($session_key);
}

}