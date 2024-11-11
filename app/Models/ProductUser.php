<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUser extends Model
{
    //
    protected $fillable =[
        'product_id',
        'user_id',
        'quantity',
    ];
}
