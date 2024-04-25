<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
  protected $fillable = ['name', 'image'];

  public function subcategories(): HasMany
  {
    return $this->hasMany(Subcategory::class);
  }

  public function products(): HasManyThrough
  {
    return $this->hasManyThrough(Product::class, Subcategory::class);
  }
}