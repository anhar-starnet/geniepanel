<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pop extends Model
{
    protected $fillable = [

        'area_id',

        'code',

        'name',

        'mikrotik_name',

        'olt_name',

        'ip_address',

        'address',

        'latitude',

        'longitude',

        'description',

        'status',

    ];

    protected $casts = [

        'status'=>'boolean',

        'latitude'=>'decimal:7',

        'longitude'=>'decimal:7',

    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function odps(): HasMany
    {
        return $this->hasMany(Odp::class);
    }
}