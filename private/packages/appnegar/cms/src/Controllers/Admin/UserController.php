<?php
namespace Appnegar\Cms\Controllers\Admin;

use App\Department;
use App\Role;
use App\User;
use Appnegar\Cms\Controllers\AdminController;
use Appnegar\Cms\Traits\Dataviewer;
use Illuminate\Http\Request;

class UserController extends AdminController{

    use Dataviewer;

    public $config;

    public function __construct(){
        $this->resource='User';
        $config=config('system.user');
        $this->config=[
            'user'=>[
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

    public function show($id)
    {
        $model_name = "App\\" . $this->resource;
        $model = $model_name::with('profile')->findOrFail($id)->toArray();

        $model = json_encode($model);
        $model = json_decode($model);
        $avatar=url($model->avatar);
        $model->avatar="<img src='$avatar'/>";
        $model=$this->filterModel($model);
//        dd(get_class($model));

        return response()->json(['model' => $model]);
    }

    protected function setModel($model)
    {
        $model['role_id']= $model->roles()->pluck('id')->toArray();
        $model['department_id']=$model->departments()->pluck('id')->toArray();

        return $model;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getFormData($data)
    {
        return [
            'model' => $data,
            'options' => [
                'role_id' => Role::get(['id', 'display_name  AS text']),
                'department_id' => Department::get(['id', 'display_name  AS text']),
            ],
            'image_path' => [],
            'name' => 'user',

        ];
    }

    /**
     * @param null $id
     * @return array
     */
    protected function validationRules($request,$id=null)
    {
        $user= $user = session('user_info_' . session('department'));
        $rules=[
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'type'=>'required',
            'profile.gender'=>'required|numeric|between:0,1',
            'avatar' => 'image|max:'.$this->config['user']['avatar']['size'] . '|mimes:' . trimArrayString($this->config['user']['avatar']['extension']),
        ];
        if($user['access_level']>=3){
            $rules['access_level']='required|numeric|min:0';
            $rules['status']='required|numeric|between:0,1';
            $rules['is_admin']='required|numeric|between:0,1';
            $rules['roles.*']='nullable|exists:roles,id';
            $rules['departments.*']='nullable|exists:departments,id';
        }
        if($id!== null){
            $rules['email']='required|email|unique:users,email,' . $id;
            $rules['username']='required|unique:users,username,' . $id;
            $rules['password']= 'confirmed';

        }
        return $rules;
    }
}