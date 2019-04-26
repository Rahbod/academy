<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\Department;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        Menu::truncate();

        $departments=Department::all();

        foreach ($departments as $department)
        {
            if ($department->name !== 'main'){
                Menu::create([
                    'name'=>$department->name,
                    'display_name'=>$department->display_name,
                    'icon_type'=>'icm_icon',
                ]);
            }

        }
    }
}
