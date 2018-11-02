<?php

use Faker\Generator as Faker;

$factory->define(App\Bus::class, function (Faker $faker) {
    return [
        'bus_number' => rand(1, 10),
        'price' => rand(4000, 8000),
        'bus_admin_id' => 1
    ];
});
