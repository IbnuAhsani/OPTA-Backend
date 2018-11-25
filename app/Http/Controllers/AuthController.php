<?php

namespace App\Http\Controllers;

use App\User;
use App\BusAdmin;
use Illuminate\Http\Request;

class AuthController extends Controller
{   
    public function login(Request $req){
        $email = $req->input('email');
        $password = $req->input('password');

        if($email == "" || $password == "") {
            // set error
            return response()->json([
                'error' => 'Email atau password tidak boleh kosong'
            ], 403);
        }

        $user = User::where('email', $email)->first();
        $bus_admin = BusAdmin::where('email', $email)->first();

        if($user == NULL && $bus_admin == NULL){
            return response()->json([
                'error' => 'Email tersebut tidak terdaftar pada aplikasi ini'
            ], 403);
        } else {
            if($user == NULL){
                if(!app('hash')->check($password, $bus_admin->password)) {
                    return response()->json([
                        'error' => 'Email atau katasandi salah, mohon dicoba lagi'
                    ], 403);
                }

                // save user id in session  
                $req->session()->put("user", ['id' => $bus_admin->id]);

                return redirect()->route('dashboard');
            } else {
                if(!app('hash')->check($req['password'], $user->password)){
                    return response()->json([
                        'error' => 'Katasandi untuk Email tersebut salah, mohon dicoba lagi'
                    ], 403);
                } else {
                    if ($user->role != 1) {
                        // save admin id in session  
                        $req->session()->put("admin", ['id' => $user->id]);

                        return redirect()->route('top_up');
                    } else {
                        return response()->json([
                            'user_id' => $user->id,
                            'token' => $user->remember_token,
                            'privilege' => '2'
                        ], 200);
                    }
                }
            }
        }
    }
}