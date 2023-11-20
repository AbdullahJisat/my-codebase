<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends BaseModel
{
  // scopes
  public function scopeIsDefault($query)
  {
    return $query->whereIsDefault(1)->first();
  }
}
