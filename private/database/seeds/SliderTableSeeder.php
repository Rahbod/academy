<?php

use App\Slider;
use App\SliderGroup;
use Illuminate\Database\Seeder;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        Slider::truncate();
        SliderGroup::truncate();

        $slider_group = SliderGroup::create([
            'name' => 'main_slider',
            'lang' => 'en',
            'special_name' => 'main_slider  ',
            'description' => 'slider group description place here',
            'order' => '1',
            'status' => '1',
        ]);
        Slider::create([
            'group_id' => $slider_group->id,
            'title' => 'slider number one',
            'lang' => 'en',
            'text' => 'slider text place here',
            'link' => 'www.test.test',
            'image' => public_path('/assets/site/media/images/main_slider/p1.jpg'),
            'status' => 1,
            'order' => 1,
        ]);
        Slider::create([
            'group_id' => $slider_group->id,
            'title' => 'slider number two',
            'lang' => 'en',
            'text' => 'slider text place here',
            'link' => 'www.test2.test',
            'image' => public_path('/assets/site/media/images/main_slider/p2.jpg'),
            'status' => 1,
            'order' => 1,
        ]);

    }
}
