<?php

namespace Database\Seeders;

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
        $this->call(ToppingsTableSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(OrderMenuSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(TableSeeder::class);
        $this->call(TimeSeeder::class);
        $this->call(ReservationTableSeeder::class);
        $this->call(AdminUsersSeeder::class);
        \App\Models\User::factory(10)->create();
    }
}
