<?php

use Illuminate\Database\Seeder;

class TopUpRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TopUpRequest::class, 8)->create();        
    }
}
