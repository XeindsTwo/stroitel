<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'login',
        'name',
        'email',
        'password',
        'role',
    ];
}

//rimiwil827@tupanda.com
//raysmorgan
