<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;

    protected $table= 'addresses';

    protected $fillable = [
        'First_Name',
        'Last_Name',
         'email',
         'mobile',
         'address',
         'state',
        'city',
        'district',
         'pincode',
         'user_id',
    ];

    public function user()
    {
       return $this->hasMany('App\Models\User', 'address_id', 'id');
    }

    public function order()
    {
       return $this->hasMany('App\Models\Order', 'address_id', 'id');
    }
}
