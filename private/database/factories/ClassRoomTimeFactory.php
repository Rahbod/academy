<?php
$factory->define(App\ClassRoomTime::class, function (Faker\Generator $faker) {
    return
        [
            'class_room_id' => function () {
                return factory(App\ClassRoom::class)->create()->id;
            },
            'start_time' => \Carbon\Carbon::now(),
            'end_time' => \Carbon\Carbon::now()->addHour(2),
            'week_day' => $faker->randomElement(['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday']),
        ];
});