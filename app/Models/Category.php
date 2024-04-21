<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
  protected $fillable = ['name', 'image'];

  public function subcategories(): HasMany
  {
    return $this->hasMany(Subcategory::class);
  }
}