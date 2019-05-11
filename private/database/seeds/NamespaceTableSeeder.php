<?php

use Illuminate\Database\Seeder;
use App\SpNamespace;

class NamespaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        SpNamespace::truncate();

        SpNamespace::create([
            'name' => 'SystemManagement',
            'display_name' => 'مدیریت سیستم',
        ]);

        SpNamespace::create([
            'name' => 'Admin',
            'display_name' => 'مدیریت محتوا',
        ]);

        SpNamespace::create([
            'name' => 'Profile',
            'display_name' => 'پنل کاربری',
        ]);
    }
}
