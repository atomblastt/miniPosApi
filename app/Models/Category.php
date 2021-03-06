<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'category_id',
        'category_name'
    ];
    protected $hidden = ['update_at'];

}
