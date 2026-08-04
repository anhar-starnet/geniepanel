<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
     * Relasi ke Port Splitter.
     */
    public function splitterPort(): BelongsTo
    {
        return $this->belongsTo(SplitterPort::class);
    }

    /**
     * Relasi ke Customer.
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * Scope ONT aktif.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', true);
    }

    /**
     * Nama perangkat.
     */
    public function displayName(): string
    {
        return trim(
            "{$this->vendor} {$this->model}"
        );
    }

    /**
     * Sudah dipasang ke splitter?
     */
    public function isDeployed(): bool
    {
        return !is_null($this->splitter_port_id);
    }

    /**
     * Sudah dipakai customer?
     */
    public function isAssigned(): bool
    {
        return $this->customer()->exists();
    }

    /**
     * Badge Deploy.
     */
    public function deploymentBadge(): string
    {
        return $this->isDeployed()
            ? 'primary'
            : 'secondary';
    }

    /**
     * Text Deploy.
     */
    public function deploymentText(): string
    {
        return $this->isDeployed()
            ? 'DEPLOYED'
            : 'STOCK';
    }

    /**
     * Badge Status.
     */
    public function statusBadge(): string
    {
        return $this->status
            ? 'success'
            : 'danger';
    }

    /**
     * Text Status.
     */
    public function statusText(): string
    {
        return $this->status
            ? 'Aktif'
            : 'Nonaktif';
    }
}