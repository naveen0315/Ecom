<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $table = 'shipments';

    protected $fillable = [

    'shipment_status',
    'tracking_no',

    ];

    public function orders_ship(){
        return $this->hasMany('App\Models\Order', 'shipment_id', 'id');
    }
}
