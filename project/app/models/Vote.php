<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = "vote";
    protected $fillable = ['product_id','vote','one','two','three','four','five'];
}
