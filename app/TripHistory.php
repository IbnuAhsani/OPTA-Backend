<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripHistory extends Model
{
    protected $table = "trip_history";

    protected $fillable = [
        'ticket_price', 'on_board_time', 'created_at', 'updated_at', 'user_id', 'bus_id', 
    ];
}
