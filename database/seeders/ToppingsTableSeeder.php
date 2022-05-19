<?php

namespace Database\Seeders;

use App\Models\Topping;
use Illuminate\Database\Seeder;

class ToppingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topping::truncate();

        $toppings = [
                [
                    'name' => 'Telur Puyuh',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'price' => '2000',
                    'image' => 'addon-puyuh.png',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Kacang',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'price' => '1000',
                    'image' => 'addon-kacang.png',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
        
        Topping::insert($toppings);
    }
}
