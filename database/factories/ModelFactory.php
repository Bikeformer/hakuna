<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('1234'),
    ];
});

$factory->define(App\Sector::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text(10),
    ];
});

$factory->define(App\Reservation::class, function (Faker\Generator $faker) {
    $user_count = App\User::count();
    $seat_count = App\Seat::count();

    return [
        'seat_id' => $faker->unique()->numberBetween(1, $seat_count),
        'user_id' => $faker->unique()->numberBetween(2, $user_count),
    ];
});

