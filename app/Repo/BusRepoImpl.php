<?php

namespace App\Repo;

use App\Repo\BusRepo;
use App\Bus;

class BusRepoImpl implements BusRepo {
    public function get_busses(int $bus_admin_id) {
        try {
            $buses = Bus::where('bus_admin_id', $bus_admin_id)->get();
        } catch(\Exception $e) {
            return [];
        }

        if(count($buses) <= 0) {
            // set empty
            return [];
            // return view('maskapai/empty_dashboard');
        }

        $buses_map = [];

        foreach ($buses as $key => $val) {
            $buses_map[$key]['id'] = $val->id;
            $buses_map[$key]['bus_number'] = $val->bus_number;
            $buses_map[$key]['price'] = $val->price;
        }

        return $buses_map;
    }
}