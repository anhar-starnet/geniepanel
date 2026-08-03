<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ont extends Model
{
    protected $fillable = [

        'splitter_port_id',

        'code',

        'vendor',

        'model',

        'serial_number',

        'firmware',

        'genieacs_device_id',

        'status',

        'notes',

    ];

    protected $casts = [

        'status' => 'boolean',

    ];

    /**
     * Relasi ke Port Splitter
     */
    public function splitterPort(): BelongsTo
    {
        return $this->belongsTo(SplitterPort::class);
    }

    /**
     * Scope ONT aktif
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', true);
    }

    /**
     * Nama tampilan ONT
     */
    public function displayName(): string
    {
        return "{$this->vendor} {$this->model}";
    }
}