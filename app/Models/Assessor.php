<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessor extends Model
{
    protected $table = "assessor";

    protected $fillable = [
      'id',
      'firstname',
      'middlename',
      'lastname',
      'address',
      'phone',
      'status',
      'created_at',
      'updated_at',
      'deleted_at',
    ];
}
