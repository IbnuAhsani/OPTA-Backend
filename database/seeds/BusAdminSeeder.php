<?php

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
            'balance' => 10000,
            'remember_token' => str_random(10)
        ]);
        
        DB::table('bus_admin')->insert([
            'email' => "bus.admin.2@gmail.com",
            'password' => bcrypt('secret'),
            'company_name' => "Damri",
            'balance' => 5000,
            'remember_token' => str_random(10)
        ]);
        
        DB::table('bus_admin')->insert([
            'email' => "bus.admin.1@gmail.com",
            'password' => bcrypt('secret'),
            'company_name' => "Explorer 100",
            'balance' => 1000,
            'remember_token' => str_random(10)
        ]);
    }
}
