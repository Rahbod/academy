<?php
$factory->define(App\Term::class, function (Faker\Generator $faker) {

    $order=1;
    return
        [
            'course_id' => function () {
                return factory(App\Course::class)->create()->id;
            },
            'title_fa' => $faker->text(50),
            'title_en' => $faker->text(50),
            'lang' => 'en',
            'description_fa' => $faker->text(100),
            'description_en' => $faker->text(100),
            'status' => random_int(0,1),
            'order' => $order++,
        ];


});