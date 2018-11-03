<?php

namespace App\Http\Controllers;

use App\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function viewOneBus($bus_id){
        $bus = Bus::find($bus_id);
        
        return response()->json($bus, 200);
    }

    public function viewRoutes(){
        $busses = Bus::all();
        $routes = [];

        for($i = 0; $i < count($busses); $i++){

            $route = Bus::find($busses[$i]['id'])->routes()->orderBy('queue')->get();
            
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

    /* public function viewOneRoute($bus_id){
        $routes = Bus::find($bus_id)->routes()->orderBy('queue')->get();

        $startLoc = $routes[0]['location_name'];
        $endLoc = $routes[count($routes)-1]['location_name'];

        return response()->json([
            'status_code' => 200,
            'start_loc' => $startLoc,
            'end_loc' => $endLoc,
            'detail' => $routes
        ]);
    } */
}
