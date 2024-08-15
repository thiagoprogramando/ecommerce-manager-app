<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'name',
        'value',
        'coupon_id',
        'status',
        'payment_token',
        'tracking_code',
        'license'
    ];
}
