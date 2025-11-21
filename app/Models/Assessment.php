<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = "assessment";

    protected $fillable = [
      'id',
      'properties_id',
      'property_type',
      'assessor_id',
      'market_id',
      'date',
      'survey_no',
      'arp_no',
      'otc',
      'pin',
      'istaxable',
      'sub_classification',
      'isexempted',
      'created_at',
      'updated_at',
      'deleted_at',
      'outlet_road',
      'dirt_road',
      'weather_road',
      'provincial_road'
    ];
}
