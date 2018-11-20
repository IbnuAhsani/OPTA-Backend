<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    protected $table = "withdraw_request";

    protected $fillable = [
        'nominal', 'accepted_status', 'bus_admin_id'
    ];

    public function busAdmin(){
        return $this->belongsTo('App\BusAdmin', 'bus_admin_id');
    }
}