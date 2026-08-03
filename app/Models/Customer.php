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

        'latitude'  => 'decimal:7',
        'longitude' => 'decimal:7',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function ont(): BelongsTo
    {
        return $this->belongsTo(Ont::class);
    }

    public function pop(): BelongsTo
    {
        return $this->belongsTo(Pop::class);
    }

    public function odp(): BelongsTo
    {
        return $this->belongsTo(Odp::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper
    |--------------------------------------------------------------------------
    */

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isSuspend(): bool
    {
        return $this->status === 'suspend';
    }

    public function isTerminated(): bool
    {
        return $this->status === 'terminated';
    }

    public function statusText(): string
    {
        return match ($this->status) {

            'active'      => 'Aktif',

            'suspend'     => 'Suspend',

            'terminated'  => 'Terminasi',

            default       => '-',

        };
    }

    public function badgeClass(): string
    {
        return match ($this->status) {

            'active'      => 'success',

            'suspend'     => 'warning',

            'terminated'  => 'danger',

            default       => 'secondary',

        };
    }
}