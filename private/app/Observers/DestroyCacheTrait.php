<?php

namespace App\Observers;

use App\Department;
use App\User;
use Illuminate\Support\Facades\Cache;

trait DestroyCacheTrait
{

    protected function deleteCacheDepartments(){
        \Storage::disk('local')->delete('cache/departments.json');
    }

    protected function deleteCacheActions($action){
        if($action->roles){
            foreach ($action->roles as $role){
                $cacheKey = 'actions_for_role_' . $role->id;
                Cache::forget($cacheKey);
                $this->deleteCacheUsersMenu($role->users);
            }
        }
    }

    protected function deleteCacheUsersMenu($users=null){
        if($users == null){
            $users=User::where('status',1)->where('verified',1)->where('is_admin',1)->where('access_level','>',1)->get();
        }
        if($users){
            $departments=Department::select(['name'])->get()->pluck('name');
            foreach ($users as $user){
                foreach ($departments as $department){
                    $cacheKey='user_admin_menu_'.$department.'_'.$user['id'];
                    Cache::forget($cacheKey);
                }
            }
        }
    }
}
