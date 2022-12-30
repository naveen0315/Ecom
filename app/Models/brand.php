<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;
    protected $table = 'brands';

    protected $fillable = [

        'brand_name'
    ];

    public function Product()
    {
       return $this->hasMany('App\Models\Product', 'brand_id', 'id');
    }

}
