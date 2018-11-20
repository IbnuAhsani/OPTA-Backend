<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripHistory extends Model
{
    protected $table = "trip_history";

    protected $fillable = [
        'ticket_price', 'on_board_time', 'user_id', 'bus_id', 
    ];
}
