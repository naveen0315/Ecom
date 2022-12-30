<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey ='id';

    protected $fillable = [
            'role_id',
            'product_id',
            'address_id',
            'order_id',
            'cart_id',
            'wishlist_id',
            'First_Name',
            'Last_Name',
            'email' ,
            'mobile',
            'gender',
            'password',
            'status',
            'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_address(){
        return $this->belongsTo('App\Models\address', 'address_id', 'id');
    }

    public function emailRelation(){
        return $this->hasMany('App\Models\Order', 'user_id', 'id');
    }
}
