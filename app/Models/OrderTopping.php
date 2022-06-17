<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTopping extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'created_at',
        'updated_at',
        'invoice',
        'midtrans_order_id',
        'user_id',
        'table',
        'status',
        'total',
        'payment',
    ];
}
