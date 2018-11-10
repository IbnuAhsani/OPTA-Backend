<?php

namespace App\Http\Controllers;

use App\User;
use App\Bus;
use App\TopUpRequest;
use App\TripHistory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $request['remember_token'] = str_random(60);
        $request['password'] = app('hash')->make($request['password']);

        $user = User::create($request->all());

        return response()->json(200);
    }

    public function viewOneUser($user_id){
        $user = User::find($user_id);

        return response()->json($user, 200);
    }

    public function pay(Request $request){
        $userId = $request['user_id'];
        $busId = $request['bus_id'];

        $user = User::find($userId);
        $bus = Bus::find($busId); 

        if($user['balance'] < $bus['price']) {
            return response()->json([
                'status' => false,
                'error' => "Saldo Kamu tidak cukup untuk membayar tiket Bus ini",
                'price' => $bus['price']
            ], 200);
        } else {
            $newBalance = $user['balance'] - $bus['price'];
    
            $user->balance = $newBalance;
            $user->save();

            TripHistory::create(
                array(
                    'user_id' => $userId,
                    'bus_id' => $busId,
                    'on_board_time' => time()
                )
            );

            return response()->json([
                'status' => true,
                'error' => null,
                'price' => $bus['price'], 
            ], 200);
        }
    }

    public function requestTopup(Request $request){        
        $request['unique_code'] = rand(0, 999);
        $request['request_time'] = time();
        $request['expire_time'] = time() + 172800000;

        $topUpRequest = TopUpRequest::create($request->all());

        return response()->json([
            'error' => null
        ], 200);
    }

    public function viewBalance(Request $request){
        $balance = User::select('balance')->where('id', $request['user_id'])->get();

        return response()->json($balance, 200);
    }
}
