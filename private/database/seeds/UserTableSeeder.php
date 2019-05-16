<?php

use Illuminate\Database\Seeder;
use  App\User;
use App\Profile;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        User::truncate();
        Profile::truncate();


        $user = User::create([
            'username' => 'admin',
            'name' => 'مدیر کل',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'type'=>'admin',

            'is_admin' => 1,
            'status' => 1,
            'verified' => 1,
            'access_level' => 3
        ]);
        Profile::create([
            'user_id' => $user->id,
            'mobile_number' => '00000',
            'melli_code' => '00000',
            'gender' => 0,
            'grade' => 'متوسطه',
            'birthday' => mt_rand(1340, 1380) . '/' . mt_rand(1, 12) . '/' . mt_rand(01, 25),
        ]);

        $user = User::create([
            'username' => 'hayatollah',
            'name' => 'حیات الله رحیمی',
            'email' => 'mr.rahimi@outlook.com',
            'password' => bcrypt('124934969'),
            'type'=>'admin',

            'is_admin' => 1,
            'status' => 1,
            'verified' => 1,
            'access_level' => 3
        ]);
        Profile::create([
            'user_id' => $user->id,
            'mobile_number' => '09355055487',
            'melli_code' => '0000000',
            'gender' => 0,
            'grade' => 'متوسطه',
            'birthday' => '1989/01/01'
        ]);

        factory('App\Profile', 10)->create();
    }
}
