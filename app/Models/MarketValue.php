<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketValue extends Model
{
    protected $table = "market_value";

    protected $fillable =[
      'id',
      'property_list',
      'class',
      'value',
      'created_at',
      'updated_at',
      'deleted_at',
    ];
}
