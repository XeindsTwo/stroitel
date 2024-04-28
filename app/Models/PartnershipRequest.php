<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipRequest extends Model
{
  protected $fillable = [
    'email',
    'organization_name',
    'phone',
    'comment'
  ];
}