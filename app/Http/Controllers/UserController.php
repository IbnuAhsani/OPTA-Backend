<?php

namespace App\Http\Controllers;

use App\User;
use App\Bus;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
                "status_code" => 403,
                "error" => "Saldo Kamu tidak cukup untuk membayar tiket Bus ini",
                "price" => $bus['price']
            ]);
        } else {
            $newBalance = $user['balance'] - $bus['price'];
    
            $user->balance = $newBalance;
            $user->save();
    
            return response()->json([
                "status_code" => 200,
                "error" => null,
                "price" => $bus['price'], 
            ]);
        }
    }
}
