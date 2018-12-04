<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\TopUpRequest::class, function (Faker $faker) {
    return [
        'accepted_status' => $faker->boolean(),
        'unique_code' => rand(1, 999),
        'nominal' => rand(20000, 30000),
        'request_time' => mt_rand(1262055681,1262255681),
        'expire_time' => mt_rand(1262355681,1262455681),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'user_id' => rand(1, 3)
    ];
});
