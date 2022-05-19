<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'user_id',
        'reservation_date',
        'reservation_time',
        'status',
        'total',
        'proof',
    ];
}
