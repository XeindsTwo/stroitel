<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
  protected $fillable = [
    'user_id',
    'name',
    'phone_number',
    'email',
    'delivery_address',
    'comment',
    'delivery_option',
    'payment_option',
    'total_price'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function products(): BelongsToMany
  {
    return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
  }
}