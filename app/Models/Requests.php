<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $table = "request";

    protected $fillable = [
      'id',
      'users_id',
      'assessment_id',
      'status',
      'request_form',
      'certificate',
      'proff_of_transfer',
      'authorizing',
      'updated_tax',
      'transfer_tax',
      'tax_reciept',
      'created_at',
      'updated_at',
      'deleted_at'
    ];
}
