<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_code',
        'name',
        'phone',
        'email',
        'address',
        'latitude',
        'longitude',
        'pppoe_username',
        'serial_number',
        'status',
    ];
}
