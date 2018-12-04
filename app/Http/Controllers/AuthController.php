<?php

namespace App\Http\Controllers;

use App\Repo\Role;
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

        // check if it's user or bus_admin
        if($user == NULL && $bus_admin == NULL){
            return response()->json([
                'error' => 'Email tersebut tidak terdaftar pada aplikasi ini'
            ], 403);
        } 

        if($user == NULL){
            if(!app('hash')->check($password, $bus_admin->password)) {
                return response()->json([
                    'error' => 'Email atau katasandi salah, mohon dicoba lagi'
                ], 403);
            }
            
            // if it's bus admin
            // save user id & role in session  
            $req->session()->put("user", ['id' => $bus_admin->id, 'role' => Role::$BUS_ADMIN]);

            return redirect()->route('dashboard');
        } 

        // if it's user, but the creds not match any
        if(!app('hash')->check($req['password'], $user->password)){
            return response()->json([
                'error' => 'Katasandi untuk Email tersebut salah, mohon dicoba lagi'
            ], 403);
        } 
        
        // this must be the admin
        if ($user->role != 1) {
            // save admin id in session  
            $req->session()->put("admin", ['id' => $user->id, 'role' => Role::$ADMIN]);

            return redirect()->route('admin_top_up');
        } 

        // this must be user
        return response()->json([
            'user_id' => $user->id,
            'token' => $user->remember_token,
            'privilege' => '2'
        ], 200);
    }

    public function login_admin_maskapai(Request $req){
        $email = $req->input('email');
        $password = $req->input('password');

        if($email == "" || $password == "") {
            // set error
            return redirect()->route('root'); 
        }

        
        // so, this might be the admin
        $user = User::where('email', $email)->first();
        $bus_admin = BusAdmin::where('email', $email)->first();
        if($bus_admin == NULL){
            // if it's user, but the creds not match any
            if(!app('hash')->check($password, $user->password)){
                return redirect()->route('root');
            } 

            // check if this is the admin
            if ($user->role == Role::$ADMIN) {
                // save admin id in session  
                $req->session()->put("admin", ['id' => $user->id, 'role' => Role::$ADMIN]);
                return redirect()->route('admin_top_up');
            }

            return redirect()->route('root');
        } 

        if(!app('hash')->check($password, $bus_admin->password)) {
            return redirect()->route('root');
        }
        
        // if it is, save user id & role in session  
        $req->session()->put("maskapai", ['id' => $bus_admin->id, 'role' => Role::$BUS_ADMIN]);

        return redirect()->route('dashboard');
    }
}