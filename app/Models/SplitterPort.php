<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SplitterPort extends Model
{
    protected $fillable = [

        'splitter_id',

        'port_number',

        'status',

        'ont_id',

    ];

    /**
     * Relasi ke Splitter
     */
    public function splitter(): BelongsTo
    {
        return $this->belongsTo(Splitter::class);
    }

    /**
     * Relasi ke ONT
     * (akan digunakan pada Sprint 4)
     */
    public function ont(): BelongsTo
    {
        return $this->belongsTo(Ont::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Status
    |--------------------------------------------------------------------------
    */

    public function isFree(): bool
    {
        return $this->status === 'FREE';
    }

    public function isUsed(): bool
    {
        return $this->status === 'USED';
    }

    public function isReserved(): bool
    {
        return $this->status === 'RESERVED';
    }

    public function isBroken(): bool
    {
        return $this->status === 'BROKEN';
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilan Status
    |--------------------------------------------------------------------------
    */

    public function statusText(): string
    {
        return match ($this->status) {

            'FREE'      => 'Kosong',

            'USED'      => 'Terpakai',

            'RESERVED'  => 'Dicadangkan',

            'BROKEN'    => 'Rusak',

            default     => '-',

        };
    }

    public function badgeClass(): string
    {
        return match ($this->status) {

            'FREE'      => 'success',

            'USED'      => 'primary',

            'RESERVED'  => 'warning',

            'BROKEN'    => 'danger',

            default     => 'secondary',

        };
    }
}