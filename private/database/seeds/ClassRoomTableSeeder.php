<?php

use Illuminate\Database\Seeder;

class ClassRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

//        factory('App\ClassRoom', 40)->create();
        factory('App\ClassRoomTime', 80)->create();
    }
}
