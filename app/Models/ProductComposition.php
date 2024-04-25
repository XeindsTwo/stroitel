<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductComposition extends Model
{
  protected $fillable = [
    'product_id',
    'property_name',
    'property_value'
  ];

  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class);
  }
}