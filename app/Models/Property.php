<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = "properties";

    protected $fillable = [
      'id',
      'users_id',
      'owner',
      'lot_number',
      'address',
      'property_type',
      'area',
      'latitude',
      'longitude',
      'elevation',
      'status',
      'previous_owner',
      'north',
      'south',
      'west',
      'east',
      'brgy',
      'street',
      'municipality',
      'provincial',
      'tin',
      'created_at',
      'updated_at',
      'deleted_at',
    ];
}
