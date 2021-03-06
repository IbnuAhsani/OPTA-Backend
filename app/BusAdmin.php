<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusAdmin extends Model
{
    protected $table = "bus_admin";

    protected $fillable = [
        'email', 'password', 'company_name', 'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function busses(){
        return $this->hasMany('App\Bus', 'bus_admin_id');
    }

    public function withdrawRequests(){
        return $this->hasMany('App\WithdrawRequest', 'bus_admin_id');
    }
}
