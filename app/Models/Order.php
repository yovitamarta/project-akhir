<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'customer_name',
        'customer_phone',
        'items',
        'total_price',
        'status',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
