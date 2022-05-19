<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Table::truncate();

        $tables = [
                [
                    'table' => '1',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '2',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '3',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '4',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '5',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '6',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '7',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '8',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '9',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '10',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '11',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '12',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '13',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '14',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '15',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '16',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '17',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '18',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '19',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '20',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '21',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '22',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '23',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '24',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '25',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '26',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '27',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '28',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '29',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'table' => '30',
                    'status' => 'Tersedia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
        
            Table::insert($tables);
    }
}
