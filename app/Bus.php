<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'bus';

    protected $fillable = [
        'bus_number', 'price', 'bus_admin_id'
    ];

    public function routes(){
        return $this->hasMany('App\Route', 'bus_id');
    }

    public function busAdmin(){
        return $this->belongsTo('App\BusAdmin', 'bus_admin_id');
    }
}
