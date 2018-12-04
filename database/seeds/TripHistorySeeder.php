<?php

use Illuminate\Database\Seeder;

class TripHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TripHistory::class, 20)->create();       
    }
}
