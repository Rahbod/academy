<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(NamespaceTableSeeder::class);
//        $this->call(DepartmentTableSeeder::class);
//        $this->call(ResourceTableSeeder::class);
//        $this->call(ActionTableSeeder::class);
//        $this->call(UserTableSeeder::class);
//        $this->call(RolesTableSeeder::class);
//        $this->call(MenusTableSeeder::class);
//        $this->call(MenuItemsTableSeeder::class);
//        $this->call(SettingsTableSeeder::class);
//        $this->call(CourseTableSeeder::class);
//        $this->call(ClassRoomTableSeeder::class);
        $this->call(ContentTableSeeder::class);
//        $this->call(CategoryTableSeeder::class);
    }

}
