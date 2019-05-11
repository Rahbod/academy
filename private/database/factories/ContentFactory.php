<?php
$factory->define(App\Content::class, function (Faker\Generator $faker) {
    $categories = App\Category::pluck('id')->toArray();

    return [
        'category_id' => $faker->randomElement($categories),
        'title' => $faker->text(50),
        'lang' => 'en',
        'type' => 'news',
        'summary' => $faker->text(50),
        'text' => $faker->text(100),
        'order' => 1,
        'status' => 1,
        'logo' => 'france.jpg',
        'image' => 'france.jpg',
        'source' => 'test.test',
        'source_link' => 'test.test',
        'show_count' => 50,
    ];
});