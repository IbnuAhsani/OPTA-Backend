<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('route')->insert([
            'location_name' => "Elang",
            'queue' => 1,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 1
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Leuwi Panjang",
            'queue' => 2,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 1
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Cileunyi",
            'queue' => 3,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 1
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Jatinangor",
            'queue' => 4,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 1
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Cibiruy",
            'queue' => 1,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 2
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Cimahi",
            'queue' => 2,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 2
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Alun-alun",
            'queue' => 3,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 2
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Dipatiukur",
            'queue' => 1,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 3
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Gedung Sate",
            'queue' => 2,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 3
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Jl. Ahmda Yani",
            'queue' => 3,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 3
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Laswi",
            'queue' => 4,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 3
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Cileunyi",
            'queue' => 5,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 3
        ]);
        
        DB::table('route')->insert([
            'location_name' => "Jatinangor",
            'queue' => 6,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 3
        ]);
        
        /* DB::table('route')->insert([
            'location_name' => ,
            'queue' => ,
            'latitude' => mt_rand()/mt_getrandmax(),
            'longitude' => mt_rand()/mt_getrandmax(),
            'bus_id' => 3
        ]); */
    }
}
