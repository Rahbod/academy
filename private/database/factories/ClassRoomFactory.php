<?php
$factory->define(App\ClassRoom::class, function (Faker\Generator $faker) {

    $fake = Faker\Factory::create('fa_IR');
    $order = 1;

    return

        [
            'term_id' => function () {
                return factory(App\Term::class)->create()->id;
            },
            'title_fa' => $fake->text(50),
            'title_en' => $faker->text(50),
            'lang' => 'en',
            'description_fa' => $fake->text(100),
            'description_en' => $faker->text(100),
            'capacity' => $faker->numberBetween(20, 40),
            'price' => $faker->numberBetween(400000, 1000000),
            'status' => random_int(0, 1),
            'registration_start_date' => \Carbon\Carbon::now(),
            'registration_end_date' => \Carbon\Carbon::now()->addMonth(1),
            'course_start_date' => \Carbon\Carbon::now()->addMonth(2),
            'course_end_date' => \Carbon\Carbon::now()->addMonth(6),
            'image' => 'japan.jpg',
            'order' => $order++
        ];


});