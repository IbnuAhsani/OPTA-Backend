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

        $bus = Bus::find($busId); 

        $totalTopUp = TopUpRequest::where([
                'user_id' => $userId, 
                'accepted_status' => 1
            ])->sum('nominal');

        if($totalTopUp == 0) {
            return response()->json([
                'status' => false,
                'error' => "Kamu belum mengisi saldo",
                'price' => $bus['price']
            ], 200);            
        } else if($totalTopUp < $bus['price']) {
            return response()->json([
                'status' => false,
                'error' => "Saldo Kamu tidak cukup untuk membayar tiket Bus ini",
                'price' => $bus['price']
            ], 200);
        } else {    
            TripHistory::create(
                array(
                    'ticket_price' => $bus['price'],
                    'on_board_time' => time(),
                    'user_id' => $userId,
                    'bus_id' => $busId,
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
        $newestBalance = TopUpRequest::where('user_id', $request['user_id'])
                                        ->orderBy('request_time', 'desc')
                                        ->limit(1)
                                        ->get();
                
        $newestBalance->isEmpty() ? 
            $request['unique_code'] = 1 :
            $request['unique_code'] = $newestBalance[0]['unique_code'] + 1;        
        
        $request['request_time'] = time();
        $request['expire_time'] = time() + 172800000;
        $topUpRequest = TopUpRequest::create($request->all());

        return response()->json([
            'error' => null
        ], 200);
    }

    public function viewBalance(Request $request){
        $userId = $request['user_id'];

        $totalTopUp = TopUpRequest::where([
                'user_id' => $userId, 
                'accepted_status' => 1
            ])->sum('nominal');

        $totalPayment = TripHistory::where('user_id', $userId)->sum('ticket_price');

        $balance = $totalTopUp - $totalPayment;

        return response()->json($balance, 200);
    }
}
