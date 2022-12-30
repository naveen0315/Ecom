<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $table ='payments';

    protected $fillable = [
            'transcation_no',
            'payment_type',
            'payment_status',
    ];

    public function paymentRelation(){
        return $this->hasMany('App\Models\Order', 'payment_id', 'id');
    }
}
