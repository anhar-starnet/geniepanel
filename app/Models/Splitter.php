<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Splitter extends Model
{
    protected $fillable = [

        'odp_id',

        'code',

        'name',

        'ratio',

        'total_ports',

        'used_ports',

        'description',

        'status',

    ];

    protected $casts = [

        'status' => 'boolean',

    ];

    /**
     * Relasi ke ODP
     */
    public function odp(): BelongsTo
    {
        return $this->belongsTo(Odp::class);
    }

    /**
     * Relasi ke Port Splitter
     */
    public function ports(): HasMany
    {
        return $this->hasMany(SplitterPort::class)
            ->orderBy('port_number');
    }

    /*
    |--------------------------------------------------------------------------
    | Statistik Port
    |--------------------------------------------------------------------------
    */

    public function freePortsCount(): int
    {
        return $this->ports()
            ->where('status', 'FREE')
            ->count();
    }

    public function usedPortsCount(): int
    {
        return $this->ports()
            ->where('status', 'USED')
            ->count();
    }

    public function reservedPortsCount(): int
    {
        return $this->ports()
            ->where('status', 'RESERVED')
            ->count();
    }

    public function brokenPortsCount(): int
    {
        return $this->ports()
            ->where('status', 'BROKEN')
            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Persentase Utilisasi
    |--------------------------------------------------------------------------
    */

    public function utilizationPercent(): float
    {
        if ($this->total_ports == 0) {
            return 0;
        }

        return round(
            ($this->usedPortsCount() / $this->total_ports) * 100,
            1
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Warna Progress Bar
    |--------------------------------------------------------------------------
    */

    public function utilizationColor(): string
    {
        $percent = $this->utilizationPercent();

        if ($percent >= 90) {
            return 'danger';
        }

        if ($percent >= 70) {
            return 'warning';
        }

        return 'success';
    }
}