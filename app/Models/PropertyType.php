<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $table = "property_type";

    protected $fillable = [
      'id',
      'assessment_rate',
      'property_list',
      'created_at',
      'updated_at',
      'deleted_at',
    ];
}
