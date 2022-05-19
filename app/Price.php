<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    public $table = 'prices';
    protected $fillable = [
            'price',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
}
