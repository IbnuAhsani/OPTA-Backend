<?php

namespace App\Repo;

use App\TopUpRequest;
use App\WithdrawRequest;
use App\TripHistory;
use App\Repo\AdminRepo;

class AdminRepoImpl implements AdminRepo{

    public function getTopUpRequest(){
        try{
            $top_up_request = TopUpRequest::where('accepted_status', 0)->get();
        } catch(\Exception $e){
            return [];
        }

        if (count($top_up_request) <= 0) {
            return [];
        }

        $top_up_request_map = [];

        foreach ($top_up_request as $key => $val) {
            $top_up_request_map[$key]['id'] = $val->id;
            $top_up_request_map[$key]['accepted_status'] = $val->accepted_status;
            $top_up_request_map[$key]['unique_code'] = $val->unique_code;
            $top_up_request_map[$key]['nominal'] = $val->nominal;
            $top_up_request_map[$key]['request_time'] = $val->request_time;
            $top_up_request_map[$key]['expire_time'] = $val->expire_time;
            $top_up_request_map[$key]['created_at'] = $val->created_at;
            $top_up_request_map[$key]['updated_at'] = $val->updated_at;
            $top_up_request_map[$key]['user_id'] = $val->user_id;                                                            
        }

        return $top_up_request_map;
    }

    public function getWithdrawRequest(){        
        try{
            $withdraw_request = WithdrawRequest::where('accepted_status', 0)->get();
        } catch(\Exception $e){
            return [];
        }

        if (count($withdraw_request) <= 0) {
            return [];
        }

        $withdraw_request_map = [];

        foreach ($withdraw_request as $key => $val) {
            $withdraw_request_map[$key]['id'] = $val->id;
            $withdraw_request_map[$key]['nominal'] = $val->nominal;
            $withdraw_request_map[$key]['accepted_status'] = $val->accepted_status;
            $withdraw_request_map[$key]['created_at'] = $val->created_at;
            $withdraw_request_map[$key]['updated_at'] = $val->updated_at;
            $withdraw_request_map[$key]['bus_admin_id'] = $val->bus_admin_id;                                                            
        }

        return $withdraw_request_map;
    }

    public function getManifestoData(){
        try {
            $manifesto = TripHistory::all();
        } catch (\Exception $e) {
            return [];
        }

        $manifesto_map = [];

        foreach ($manifesto as $key => $val) {
            $manifesto_map[$key]['id'] = $val->id;
            $manifesto_map[$key]['ticket_price'] = $val->ticket_price;
            $manifesto_map[$key]['on_board_time'] = $val->on_board_time;
            $manifesto_map[$key]['created_at'] = $val->created_at;
            $manifesto_map[$key]['updated_at'] = $val->updated_at;
            $manifesto_map[$key]['user_id'] = $val->user_id;                                                            
            $manifesto_map[$key]['bus_id'] = $val->bus_id;                                                            
        }

        return $manifesto_map;  
    }
}

?>