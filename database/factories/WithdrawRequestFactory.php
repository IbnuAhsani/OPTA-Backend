<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\WithdrawRequest::class, function (Faker $faker) {
    return [
        'nominal' => rand(4000, 10000),
        'accepted_status' => $faker->boolean(),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'bus_admin_id' => rand(1, 3),
    ];
});
