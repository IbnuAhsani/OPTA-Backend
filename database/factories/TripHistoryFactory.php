<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\TripHistory::class, function (Faker $faker) {
    return [
        'ticket_price' => rand(4000, 8000),
        'on_board_time' => mt_rand(1262055681,1262255681),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'user_id' => rand(1, 3),
        'bus_id' => rand(1, 6),
    ];
});
