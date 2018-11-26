<?php

namespace App\Repo;

interface MoneyRepo {
    public function user_balance(int $user_id);
    // get the maskapai money that can be withdrawed
    public function maskapai_wd(int $maskapai_id);
    // maskapai withdraw request
    public function maskapai_do_wd(int $maskapai_id);
    // get the history of maskapai withdraw
    public function maskapai_wd_hist(int $maskapai_id);
}