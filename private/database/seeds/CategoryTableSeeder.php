<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counter = 1;
        Category::create([
            'name' => 'news',
            'special_name' => 'news',
            'lang' => 'en',
            'type' => 'news',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto commodi cumque cupiditate delectus, doloremque eius eum expedita fugiat ist',
            'order' => $counter++,
            'status' => 1,
            'published_at' => \Carbon\Carbon::now(),
        ]);
        Category::create([
            'name' => 'article',
            'special_name' => 'article',
            'lang' => 'en',
            'type' => 'article',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto commodi cumque cupiditate delectus, doloremque eius eum expedita fugiat ist',
            'order' => $counter++,
            'status' => 1,
            'published_at' => \Carbon\Carbon::now(),
        ]);

        Category::create([
            'name' => 'course',
            'special_name' => 'course',
            'lang' => 'en',
            'type' => 'course',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto commodi cumque cupiditate delectus, doloremque eius eum expedita fugiat ist',
            'order' => $counter++,
            'status' => 1,
            'published_at' => \Carbon\Carbon::now(),
        ]);
        Category::create([
            'name' => 'translation',
            'special_name' => 'translation',
            'lang' => 'en',
            'type' => 'translation',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto commodi cumque cupiditate delectus, doloremque eius eum expedita fugiat ist',
            'order' => $counter++,
            'status' => 1,
            'published_at' => \Carbon\Carbon::now(),
        ]);

    }
}
