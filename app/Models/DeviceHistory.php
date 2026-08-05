<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceHistory extends Model
{
    protected $table = 'device_history';

    protected $fillable = [

        'device_id',
        'serial_number',

        'manufacturer',
        'product_class',

        'online',

        'rx_power',
        'temperature',
        'uptime',

        'pppoe_username',
        'pppoe_ip',

        'last_inform',

    ];

    protected $casts = [

        'online' => 'boolean',

        'last_inform' => 'datetime',

        'rx_power' => 'float',

        'temperature' => 'float',

    ];

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */

    public function scopeOnline($query)
    {
        return $query->where('online', true);
    }

    public function scopeOffline($query)
    {
        return $query->where('online', false);
    }

    public function scopeToday($query)
    {
        return $query->whereDate(
            'created_at',
            today()
        );
    }

    public function scopeSerial($query, string $serial)
    {
        return $query->where(
            'serial_number',
            $serial
        );
    }
}