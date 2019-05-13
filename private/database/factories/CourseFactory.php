<?php
$factory->define(App\Course::class, function (Faker\Generator $faker) {

    return [
        'title_fa' => $faker->text(50),
        'title_en' => $faker->text(50),
        'lang' => 'en',
        'duration' => $faker->numberBetween(2, 7),
        'description_fa' => $faker->text(100),
        'description_en' => $faker->text(100),
        'order' => '1',
        'status' => random_int(0,1),
        'published_at' => \Carbon\Carbon::now(),
        'image' => 'france.jpg'
    ];
});