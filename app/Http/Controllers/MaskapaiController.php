<?php

namespace App\Http\Controllers;

use App\BusAdmin;
use App\Bus;
use App\TopUpRequest;
use App\TripHistory;
use Illuminate\Http\Request;
use App\Repo\BusRepoImpl;

class MaskapaiController extends Controller {
    // Session KEY
    const SESS_USER = "user";

    private $bus_repo;

    public function __construct() {
        $this->bus_repo = new BusRepoImpl();
    }

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
        $id = $req->session()->get("user")['id'];
        $buses = $this->bus_repo->get_busses($id);
        return view('maskapai/dashboard', ['busses' => $buses]);    
    }

    public function add_bus(Request $req) {
        $bus_number = $req->input('bus_number');
        $price = $req->input('price');
        $bus_admin_id = $req->session()->get("user")['id'];

        // validator
        // ...

        $bus_data = [
            'bus_number' => $bus_number, 
            'price' => $price, 
            'bus_admin_id' => $bus_admin_id
        ];
        
        try {
            $bus = Bus::create($bus_data);
            $busses = $this->bus_repo->get_busses($bus_admin_id);

            return view('maskapai/dashboard', ['busses' => $busses]);
        } catch (\Throwable $th) {
            // log the exception
            return response()->json(['error' => 'Sistem bermasalah'], 400);
        }
    }
}