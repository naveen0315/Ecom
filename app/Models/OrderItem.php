<?php

namespace App\Models;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price', 'order_status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    public function productData()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

 }
