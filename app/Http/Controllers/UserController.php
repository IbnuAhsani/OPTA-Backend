<?php

namespace App\Http\Controllers;

use App\User;
use App\Bus;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $request['remember_token'] = str_random(60);
        $request['password'] = app('hash')->make($request['password']);
        $user = User::create($request->all());

        return response()->json(200);
    }

    public function login(Request $request){
        $user = User::where('email', $request['email'])->first();
        
        if(!$user){
            return response()->json([
                'status_code' => 403,
                'error' => 'Email tersebut tidak terdaftar pada aplikasi ini'
            ]);
        } else {
            if(!app('hash')->check($request['password'], $user->password)){
                return response()->json([
                    'status_code' => 403,
                    'error' => 'Katasandi untuk Email tersebut salah, mohon dicoba lagi'
                ]); 
            } else {
                return response()->json([
                    'user_id' => $user->id,
                    'token' => $user->remember_token
                ]);
            }
        }
    }
    
    public function viewOneUser($user_id){
        $user = User::find($user_id);

        return response()->json($user, 200);
    }

    public function pay(Request $request){
        $user_id = $request->input('user_id');
        $bus_id = $request->input('bus_id');

        $user = User::find($user_id);
        $bus = Bus::find($bus_id); 

        if($user['balance'] < $bus['price']) {
            return response()->json([
                'status_code' => 403,
                'error' => "Saldo Kamu tidak cukup untuk membayar tiket Bus ini",
                'price' => $bus['price']
            ]);
        } else {
            $newBalance = $user['balance'] - $bus['price'];
    
            $user->balance = $newBalance;
            $user->save();
    
            return response()->json([
                'status_code' => 200,
                'error' => null,
                'price' => $bus['price'], 
            ]);
        }
    }
}
