<?php

namespace App\Repo;

use App\TopUpRequest;
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
            $top_up_request_map[$key]['unique_code'] = $val->unique_code;
            $top_up_request_map[$key]['nominal'] = $val->nominal;
            $top_up_request_map[$key]['request_time'] = $val->request_time;
            $top_up_request_map[$key]['expire_time'] = $val->expire_time;
            $top_up_request_map[$key]['user_id'] = $val->user_id;                                                            
        }

        return $top_up_request_map;
    }

    public function getWithdrawRequest(){
        $withdraw_request = TripHistory::where('accepted_status', 0)->get();

        return $withdraw_request;
    }
}

?>