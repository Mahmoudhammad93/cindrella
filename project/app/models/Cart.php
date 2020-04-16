<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    protected $fillable = ['product_id', 'count','userId','productName','price','desc','image','discount','priceInDisc','totalPrice'];

    public static $productsCount = 0;
}
