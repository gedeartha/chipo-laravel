<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reservation::truncate();

        // $reservations = [
        //         [
        //             'invoice' => '1001',
        //             'midtrans_order_id' => '1001',
        //             'created_at' => now(),
        //             'user_id' => '1',
        //             'reservation_date' => '2022-04-30',
        //             'reservation_time' => '18:00',
        //             'total' => '20000',
        //             'proof' => 'proof_of_payment1.jpg',
        //             'status' => 'Sudah Dibayar',
        //         ],
        //     ];
        
        //     Reservation::insert($reservations);
    }
}
