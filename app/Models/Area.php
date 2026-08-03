<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $fillable = [

        'code',
        'name',
        'pic',
        'phone',
        'address',
        'latitude',
        'longitude',
        'status',

    ];

    protected $casts = [

        'status' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',

    ];

    public function pops(): HasMany
    {
        return $this->hasMany(Pop::class);
    }
}