<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = "building";

    protected $fillable = [
      'id',
      'assessment_id',
      'building_type',
      'status',
      'storey',
      'storey_size',
      'construction_cost',
      'structural_type',
      'complete',
      'created_at',
      'updated_at',
      'deleted_at',
    ];
}
