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
}
