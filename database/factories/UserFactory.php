<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'), // secret
        'name' => $faker->name,
        'address' => $faker->address,
        'balance' => rand(10000, 50000),
        'role' => rand(0, 1),
        'remember_token' => str_random(10),
    ];
});
