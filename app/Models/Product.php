<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
  protected $fillable = [
    'availability',
    'name',
    'price',
    'new_price',
    'description',
    'image_path',
    'category_id',
    'subcategory_id'
  ];

  public function compositions(): HasMany
  {
    return $this->hasMany(ProductComposition::class);
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function subcategory(): BelongsTo
  {
    return $this->belongsTo(Subcategory::class);
  }

  public function carts(): HasMany
  {
    return $this->hasMany(Cart::class);
  }
}