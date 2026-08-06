<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceEvent extends Model
{
    protected $table = 'device_events';

    protected $fillable = [
        'serial_number',
        'device_id',
        'event',
        'message',
        'old_value',
        'new_value',
        'created_at',
    ];

    public $timestamps = false;
}