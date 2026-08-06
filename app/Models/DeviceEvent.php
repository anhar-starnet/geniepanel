<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceEvent extends Model
{
    protected $table = 'device_events';

    public $timestamps = false;

    protected $fillable = [

        'device_id',

        'serial_number',

        'pppoe_username',

        'event',

        'reason',

        'severity',

        'confidence',

        'message',

        'old_value',

        'new_value',

        'created_at',

    ];
}