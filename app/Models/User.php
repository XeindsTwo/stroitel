<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  protected $fillable = [
    'login',
    'name',
    'email',
    'password',
    'role',
  ];

  public function carts(): HasMany
  {
    return $this->hasMany(Cart::class);
  }
}