<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Odp extends Model
{
    protected $fillable = [

        'pop_id',

        'code',

        'name',

        'distribution_type',

        'port_capacity',

        'used_ports',

        'fiber_core',

        'address',

        'latitude',

        'longitude',

        'description',

        'status',

    ];

    protected $casts = [

        'status' => 'boolean',

        'latitude' => 'decimal:7',

        'longitude' => 'decimal:7',

    ];

    /**
     * Relasi ke POP
     */
    public function pop(): BelongsTo
    {
        return $this->belongsTo(Pop::class);
    }

    /**
     * Relasi ke Splitter
     * (akan dipakai pada Sprint 3)
     */
    public function splitters(): HasMany
    {
        return $this->hasMany(Splitter::class);
    }
}