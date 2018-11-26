<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            BusTableSeeder::class,
            RouteTableSeeder::class,
            BusAdminSeeder::class,
            TopUpRequestTableSeeder::class,
            WithdrawRequestTableSeeder::class
        ]);
    }
}
