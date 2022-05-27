<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
      'package_id',
      'transaction_id',
      'payment_amount',
      'payment_method',
      'payment_status',
      'payment_currency_code',
      'is_expired',
      'expire_at',
    ];
}
