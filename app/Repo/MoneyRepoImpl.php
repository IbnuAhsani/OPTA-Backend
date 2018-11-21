<?php

namespace App\Repo;

use Illuminate\Support\Facades\DB;
use App\Repo\MoneyRepo;
use App\BusAdmin;
use App\WithdrawRequest;

class MoneyRepoImpl implements MoneyRepo {

    private $maskapai_id;

    public function user_balance(int $user_id) {
        return 0;
    }

    // get the maskapai money that can be withdrawed
    public function maskapai_wd(int $maskapai_id) {
        $this->maskapai_id = $maskapai_id;
        // get sum $user_payment from DB
        $payment = null;
        $withdrawed = null;

        try {
            DB::beginTransaction();
            
            // get payment of all users for a bus owned by bus_admin
            $payment = DB::table("trip_history")
                    ->join("bus", "bus.id" , "=", "trip_history.bus_id")
                    ->where("bus.bus_admin_id", $maskapai_id)
                    ->sum("trip_history.ticket_price");

            $withdrawed = DB::table("withdraw_request")
                    ->where("bus_admin_id", $maskapai_id)
                    ->sum("nominal");

            DB::commit();

        } catch(\Exception $e) {
            // should logged out
            dd($e);
        }

        $withdraw = 0;
        if($payment !== null && $withdrawed !== null) {
            $withdraw = $payment - $withdrawed;
        }

        return $withdraw;
    }

    public function maskapai_do_wd(int $maskapai_id) {
        $nominal = $this->maskapai_wd($maskapai_id);
        
        if($nominal <= 0) {
            return 0;
        } 

        $withdrawReq = false;

        try {
            // DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
            $withdrawReq = DB::insert('insert into withdraw_request (nominal, bus_admin_id, accepted_status) values (?, ?, ?)', 
                    [$nominal, $maskapai_id, 0]);
            
        } catch(\Exception $e) {
            dd($e);
        }

        return $withdrawReq;
    }

    // get the history of maskapai withdraw
    public function maskapai_wd_hist(int $maskapai_id) {

    }
}