<?php 

namespace App\Repo;

interface BusRepo {
    public function get_busses(int $bus_admin_id);
}