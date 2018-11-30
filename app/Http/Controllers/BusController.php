<?php

namespace App\Http\Controllers;

use App\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function viewRoutes(){
        $busses = Bus::all();
        $routes = [];

        for($i = 0; $i < count($busses); $i++){
            $route = Bus::find($busses[$i]['id'])->routes()->orderBy('queue')->get();
            if(count($route) <= 0) continue;

            $startLoc = $route[0]['location_name'];
            $endLoc = $route[count($route)-1]['location_name'];

            $arr = array(
                'id' => $i,
                'start_loc' => $startLoc,
                'end_loc' => $endLoc,
                'detail' => $route
            );

            array_push($routes, $arr);
        }

        return response()->json($routes, 200);
    }

    public function busPrice($bus_id) {
        $bus = Bus::find($bus_id);
        return response()->json( $bus['price'], 200);
    }
}
