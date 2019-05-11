<?php
$factory->define(App\ClassRoom::class, function (Faker\Generator $faker) {

    $fake = Faker\Factory::create('fa_IR');

    return

        [
            'course_id' => function () {
                return factory(App\Course::class)->make()->id;
            },
            'title_fa' => $fake->text(50),
            'title_en' => $faker->text(50),
            'lang' => 'en',
            'description_fa' => $fake->text(100),
            'description_en' => $faker->text(100),
            'capacity' => $faker->numberBetween(20, 40),
            'price' => $faker->numberBetween(400000, 1000000),
            'status' => '1',
            'registration_start_date' => $faker->dateTimeThisYear(),
            'registration_end_date' => $faker->dateTimeThisYear(),
            'course_start_date' => $faker->dateTimeThisYear(),
            'course_end_date' => $faker->dateTimeThisYear(),
            'image' => 'japan.jpg'
        ];


});