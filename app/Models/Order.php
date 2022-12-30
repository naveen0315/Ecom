<?php

namespace App\Models;
use App\Models\User;
use App\Models\Product;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'payment_id',
        // 'shipment_id',
        'name',
        'address',
        'order_status',
    ];

    public $sortable =[
        'created_at',
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function OrderItem()
    {
       return $this->hasMany(OrderItem::class);
    }
    public function shipment(){
        return $this->belongsTo('App\Models\Shipment', 'shipment_id', 'id');
    }

    public function orderRelation(){
        return $this->belongsTo('App\Models\payment', 'payment_id', 'id');
    }

    public function addressRelation(){
        return $this->belongsTo('App\Models\address', 'address_id', 'id');
    }
}
