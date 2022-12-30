<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_Order extends Model
{
    use HasFactory;

    protected $table = 'return_orders';

    protected $fillable = [
        'user_id', 'order_id', 'refund_id', 'quantity'
    ];
}
