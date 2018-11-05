<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopUpRequest extends Model
{
    protected $table = "top_up_request";

    protected $fillable = [
        'accepted_status', 'unique_code', 'nominal', 'request_time', 'expire_time', 'user_id'
    ];

    protected $hidden = [
        'unique_code'
    ];
}
