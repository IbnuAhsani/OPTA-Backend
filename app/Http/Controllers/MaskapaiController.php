<?php

namespace App\Http\Controllers;

use App\BusAdmin;
use App\Bus;
use App\TopUpRequest;
use App\TripHistory;
use Illuminate\Http\Request;

class MaskapaiController extends Controller {
    // Session KEY
    const SESS_USER = "user";

    public function home() {
        return view('maskapai/home', ['title' => $_ENV['APP_NAME']]);
    }

    public function login(Request $req) {
        $email = $req->input('email');
        $password = $req->input('password');

        if($email == "" || $password == "") {
            // set error
            return response()->json([
                'error' => 'Email atau password tidak boleh kosong'
            ], 403);
        }

        $busAdmin = BusAdmin::where('email', $email)->first();

        if($busAdmin == null) {
            // set error
            return response()->json([
                'error' => 'Akun tidak terdaftar'
            ], 403);
        }

        if(!app('hash')->check($password, $busAdmin->password)) {
            return response()->json([
                'error' => 'Email atau katasandi salah, mohon dicoba lagi'
            ], 403);
        }

        // save user id in session  
        $req->session()->put("user", ['id' => $busAdmin->id]);

        return redirect()->route('dashboard');
    }

    public function dashboard(Request $req) {
        // get session
        $id = $req->session()->get("user");

        $buses = Bus::where('bus_admin_id', $id)->get();

        if(count($buses) <= 0) {
            // set empty
            return view('maskapai/empty_dashboard');
        }

        $buses_map = [];

        foreach ($buses as $key => $val) {
            $buses_map[$key]['id'] = $val->id;
            $buses_map[$key]['bus_number'] = $val->bus_number;
            $buses_map[$key]['price'] = $val->price;
        }

        return view('maskapai/dashboard', ['buses' => $buses_map]);    
    }
}