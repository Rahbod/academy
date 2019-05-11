<?php
$factory->define(App\Course::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->text(50),
        'lang' => 'en',
        'duration' => $faker->numberBetween(2, 7),
        'description' => $faker->text(100),
        'order' => '1',
        'status' => '1',
        'published_at' => $faker->dateTime(),
        'image' => 'france.jpg'
    ];
});