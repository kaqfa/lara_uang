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
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Transaction::class, function (Faker\Generator $faker) {    
    return [
        'title' => $faker->words($nb = 3, $asText = true),
        'amount' => $faker->numberBetween($min = 10000, $max = 900000),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'type' => $faker->numberBetween($min = 1, $max = 2),
        'status' => 1,
        'user_id' => $faker->numberBetween($min = 1, $max = 11),
    ];
});