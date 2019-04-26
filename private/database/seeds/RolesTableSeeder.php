<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        Role::truncate();
        DB::table('action_role')->truncate();
        DB::table('role_user')->truncate();

        Role::create([
            'name' => 'guest',
            'display_name' => 'کاربر مهمان'
        ]);
        Role::create([
            'name' => 'super_admin',
            'display_name' => 'مدیر اصلی'
        ]);
        Role::create([
            'name' => 'admin',
            'display_name' => 'مدیر'
        ]);
        Role::create([
            'name' => 'editor',
            'display_name' => 'ویراستار'
        ]);

        $users = User::whereIn('id', [1, 2, 3])->get();
        foreach ($users as $user) {
            if ($user->username == 'rahimi' || $user->username == 'admin') {
                $user->roles()->sync([2,3]);
            } elseif ($user->username == 'quest') {
                $user->roles()->sync([1]);
            }
        }

        $users=User::where('id','>',3)->get();
        foreach ($users as $user){
            $user->roles()->sync([random_int(1,4)]);
        }

//        $count = Action::all()->count();
//        $roles = Role::where('name','super_admin')->orWhere('name','admin')->get();
//        foreach ($roles as $role) {
//
//                $role->actions()->sync(range(1, $count));
//
//        }
        $departments = \App\Department::with('resources.actions')->get();
        $roles = Role::where('name','super_admin')->orWhere('name','admin')->get();
        foreach ($departments as $department) {
            foreach ($department->resources as $resource) {
                foreach ($resource->actions as $action) {
                    if($action->need_allow == 1 ){
                        foreach ($roles as $role) {
                            $role->actions()->attach($action->id);
                        }
                    }

                }
            }
        }
    }
}
