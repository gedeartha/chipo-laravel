<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'table_id',
        'reservation_date',
        'reservation_time',
    ];
}
