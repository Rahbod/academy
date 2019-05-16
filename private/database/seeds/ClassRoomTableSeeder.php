<?php

use App\ClassRoomTime;
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
        ClassRoomTime::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

//        factory('App\ClassRoom', 40)->create();
        factory('App\ClassRoomTime', 40)->create();
    }
}
