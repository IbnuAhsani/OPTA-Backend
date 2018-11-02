<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'bus';

    protected $fillable = [
        'bus_number', 'price', 'bus_admin_id'
    ];
}
