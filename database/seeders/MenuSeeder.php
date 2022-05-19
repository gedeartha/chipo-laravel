<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Menu::truncate();

        $menus = [
                [
                    'name' => 'Bubur Ayam',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                    'price' => '15000',
                    'image' => 'menu-bubur-ayam.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
        
        Menu::insert($menus);
    }
}
