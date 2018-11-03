<?php

namespace App\Http\Controllers;

use App\BusAdmin;
use Illuminate\Http\Request;

class BusAdminController extends Controller
{
    public function register(Request $request){
      $request['remember_token'] = str_random(60);
      $request['password'] = app('hash')->make($request['password']);
      BusAdmin::create($request->all());

      return response()->json(200);
    }
}
