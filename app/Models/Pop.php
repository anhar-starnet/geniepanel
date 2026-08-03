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
     * POP belongs to Area
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * POP has many ODP
     */
    public function odps(): HasMany
    {
        return $this->hasMany(Odp::class);
    }
}