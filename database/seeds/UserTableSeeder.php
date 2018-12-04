<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 3)->create();
        
        DB::table('user')->insert([
            'email' => "hello.world@gmail.com",
            'password' => bcrypt('secret'),
            'name' => "Admin",
            'address' => "Jl. Hello World",
            'role' => 0,
            'remember_token' => str_random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),            
        ]);
    }
}
