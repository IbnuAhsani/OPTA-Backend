<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = "route";

    protected $fillable = [
        'location_name', 'queue', 'latitude', 'longitude', 'bus_id'
    ];

    public function bus(){
        return $this->belongsTo('App\Bus', 'bus_id');
    }
}
