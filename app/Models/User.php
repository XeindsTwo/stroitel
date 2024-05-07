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

  public function cartItems(): HasMany
  {
    return $this->hasMany(Cart::class);
  }

  public function orders(): HasMany
  {
    return $this->hasMany(Order::class);
  }
}