<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripHistory extends Model
{
    protected $table = "trip_history";

    protected $fillable = [
        'on_board_status', 'user_id', 'bus_id', 'on_board_time', 'exit_time'
    ];
}
