<?php

namespace App\Http\Controllers;

use App\BusAdmin;
use App\TopUpRequest;
use App\TripHistory;
use Illuminate\Http\Request;

class MaskapaiController extends Controller {
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

        return view('maskapai/dashboard');
    }

    public function dashboard(Request $req) {
        $buses = BusAdmin::all();
        
        return view('maskapai/dashboard');    
    }
}