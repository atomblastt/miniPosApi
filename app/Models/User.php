<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'username',
        'role'
    ];
    protected $hidden = ['password','update_date'];

}
