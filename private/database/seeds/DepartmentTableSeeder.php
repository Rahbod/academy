<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        Department::truncate();


        $department=Department::create([
            'namespace_id'=>1,
            'name' => 'system_management',
            'display_name' => 'مدیریت سیستم',
            'prefix' => 'system_management',
            'middleware' => null
        ]);

        $department->users()->attach([1,2]);


        $department=Department::create([
            'name' => 'site_management',
            'display_name' => 'مدیریت سایت',
            'namespace_id'=>1,
            'prefix' => 'site_management',
            'middleware' => null
        ]);

        $department->users()->attach([1,2]);


        $department=Department::create([
            'name' => 'content_management',
            'display_name' => 'مدیریت محتوا',
            'namespace_id'=>2,
            'prefix'=>'content_management',
            'middleware' => null
        ]);
        $department->users()->attach([1,2]);
        $department->users()->attach([1,2]);
    }
}
