<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuildingType extends Model
{
    protected $table = "building_type";
    protected $fillable = [
      'classification',
      'minimum_rate',
      'maximum_rate',
      'percentage',
      'created_at',
      'updated_at',
      'deleted_at'
    ];
}
