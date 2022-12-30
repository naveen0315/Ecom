<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Product extends Model
{
    use HasFactory;
    use Sortable;
    protected $primaryKey ='id';

    protected $table = 'products';

    protected $fillable = [
        'cat_id',
        'brand_id',
        'product_name',
        'description',
        'price',
        'image',
        'quantity',
        'color',
        'size',
    ];
    public $sortable =[
        'id',
        'product_name',
        'brand_id',
        'cat_id',
        'description',
        'price',
        'image',
        'quantity',
        'color',
        'size',
    ];

    public function brand(){
        return $this->belongsTo('App\Models\brand','brand_id', 'id');
    }
    public function category(){
        return $this->belongsTo('App\Models\category','cat_id', 'id');
    }


    public function cart()
    {
       return $this->hasMany('App\Models\cart', 'product_id', 'id');
    }

    public function product_data()
    {
       return $this->hasMany('App\Models\OrderItem', 'product_id', 'id');
    }


    public function wishlist()
    {
       return $this->hasMany('App\Models\wishlist', 'product_id', 'id');
    }
}
