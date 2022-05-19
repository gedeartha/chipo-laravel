<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $users = [
            [
                'name' => 'Artha',
                'email' => 'artha@chipo.com',
                'password' => 'asd',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            ];
        
            User::insert($users);
    }
}
