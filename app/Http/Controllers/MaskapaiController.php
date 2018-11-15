<?php

namespace App\Http\Controllers;

use App\BusAdmin;
use App\TopUpRequest;
use App\TripHistory;
use Illuminate\Http\Request;

class MaskapaiController extends Controller {
    public function home(Request $req) {
        $buses = BusAdmin::all();
        
        return view('maskapai/home');       
    }
}