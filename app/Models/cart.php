<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class cart extends Model
{
    use HasFactory;
    use Sortable;
    protected $primaryKey ='id';

    protected $table = 'carts';

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'price',
        'quantity',
    ];

    public $sortable =[
        'id',
        'product_id',
        'price',
        'quantity',

    ];

    public function Product(){
        return $this->belongsTo('App\Models\Product','product_id', 'id');
    }

}
