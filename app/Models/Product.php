<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'product_id',
        'user_id',
        'category_id',
        'product_code',
        'product_name',
        'description',
        'price',
        'stock',
        'image',
        'product_status'
    ];
    protected $hidden = ['update_at'];

}
