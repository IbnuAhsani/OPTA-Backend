<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BusAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bus_admin')->insert([
            'email' => "bus.admin.1@gmail.com",
            'password' => bcrypt('secret'),
            'company_name' => "Primajasa",
            'remember_token' => str_random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('bus_admin')->insert([
            'email' => "bus.admin.2@gmail.com",
            'password' => bcrypt('secret'),
            'company_name' => "Damri",
            'remember_token' => str_random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('bus_admin')->insert([
            'email' => "bus.admin.1@gmail.com",
            'password' => bcrypt('secret'),
            'company_name' => "Explorer 100",
            'remember_token' => str_random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
