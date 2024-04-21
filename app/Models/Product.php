<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'price',
    'description',
    'image_path'
  ];

  public function compositions(): HasMany
  {
    return $this->hasMany(ProductComposition::class);
  }
}