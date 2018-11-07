<?php

namespace App\Http\Controllers;

use App\User;
use App\BusAdmin;
use Illuminate\Http\Request;

class AuthController extends Controller
{   
    public function login(Request $request){
        $user = User::where('email', $request['email'])->first();
        $busAdmin = BusAdmin::where('email', $request['email'])->first();

        if($user == NULL && $busAdmin == NULL){
            return response()->json([
                'error' => 'Email tersebut tidak terdaftar pada aplikasi ini'
            ], 403);
        } else {
            if($user == NULL){
                if(!app('hash')->check($request['password'], $busAdmin->password)){
                    return response()->json([
                        'error' => 'Katasandi untuk Email tersebut salah, mohon dicoba lagi'
                    ], 403);
                } else {
                   return response()->json([
                        'user_id' => $busAdmin->id,
                        'token' => $busAdmin->remember_token
                   ], 200);
                }
            } else {
                if(!app('hash')->check($request['password'], $user->password)){
                    return response()->json([
                        'error' => 'Katasandi untuk Email tersebut salah, mohon dicoba lagi'
                    ], 403);
                } else {
                    return response()->json([
                        'user_id' => $user->id,
                        'token' => $user->remember_token
                    ], 200);
                }
            }
        }
    }   
}
