<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Midtrans extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'transaction_status',
        'created_at',
        'updated_at',
    ];
}
