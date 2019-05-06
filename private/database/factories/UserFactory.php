<?php

//$faker = Faker\Factory::create('fa_IR');

$factory->define(App\Profile::class, function (Faker\Generator $faker) {
    $fake = Faker\Factory::create('fa_IR');
    $gender = mt_rand(0, 1);
    if ($gender == 0) {
        $name = $fake->firstNameMale;
    } else {
        $name = $fake->firstNameFemale;
    }
    $full_name=$name . ' ' . $fake->lastName;

    return [
        'user_id' => function () use ($full_name) {
            return factory(App\User::class)->create(['name' => $full_name])->id;
        },
        'gender' => $gender,
        'mobile_number' => $fake->phoneNumber,
        'melli_code' => $fake->randomNumber(),
        'birthday' => mt_rand(1340, 1380) . '/' . mt_rand(1, 12) . '/' . mt_rand(01, 29),
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $fake = Faker\Factory::create('fa_IR');


    return [
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->email,
        'password' => bcrypt('123456'),
        'is_admin' => mt_rand(0, 1),
        'status' => mt_rand(0, 1),
        'verified' => mt_rand(0, 1),
        'access_level' => mt_rand(0, 3),
        'remember_token' => str_random(10),
    ];
});