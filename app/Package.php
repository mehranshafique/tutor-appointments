<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'price' ,
      'description',
      'duration' ,
      'duration_type' ,
      'auto_renew',
      'allowed_classes'
   ];
}
