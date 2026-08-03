<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    protected $fillable = [

        'customer_code',
        'name',
        'nik',
        'phone',
        'email',
        'address',

        'latitude',
        'longitude',

        'package_id',

        'pop_id',
        'odp_id',
        'ont_id',

        'pppoe_username',
        'pppoe_password',

        'serial_number',

        'status',

    ];

    protected $casts = [

        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',

    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}