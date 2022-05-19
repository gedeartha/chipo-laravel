<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Time::truncate();

        $times = [
            [
                'time' => '18:00',
            ],
            [
                'time' => '18:15',
            ],
            [
                'time' => '18:30',
            ],
            [
                'time' => '18:45',
            ],
            [
                'time' => '19:00',
            ],
            [
                'time' => '19:15',
            ],
            [
                'time' => '19:30',
            ],
            [
                'time' => '19:45',
            ],
            [
                'time' => '20:00',
            ],
            [
                'time' => '21:15',
            ],
            [
                'time' => '21:30',
            ],
            ];
        
            Time::insert($times);
    }
}
