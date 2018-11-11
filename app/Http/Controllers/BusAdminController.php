<?php

namespace App\Http\Controllers;

use App\Bus;
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
    
    public function viewOneBus(Request $request){
        $bus = Bus::find($request['bus_id']);

        return response()->json($bus, 200);
    }

    public function viewAllBusses(Request $request){
        $busses = BusAdmin::find($request['bus_admin_id'])->busses;

        return response()->json($busses, 200);
    }

    public function addBus(Request $request){
        Bus::create($request->all());

        return response()->json(200);
    }

    public function deleteBus(Request $request){
        Bus::destroy($request['bus_id']);
        // $bus->delete();

        return response()->json(200);
    }

    public function updateBus(Request $request){
        $bus = Bus::find($request['bus_id']);
        $bus->update($request->except('bus_id'));

        return response()->json(200);
    }
}
