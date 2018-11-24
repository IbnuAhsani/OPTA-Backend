<?php

use Illuminate\Database\Seeder;

class WithdrawRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\WithdrawRequest::class, 5)->create();        
    }
}
