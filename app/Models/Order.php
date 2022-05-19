<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'created_at',
        'updated_at',
        'invoice',
        'user_id',
        'table',
        'status',
        'total',
        'payment',
        'proof',
    ];
}
