<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected $fillable = [

        'code',
        'name',
        'download_kbps',
        'upload_kbps',
        'price',
        'ppn',
        'description',
        'status',

    ];

    protected $casts = [

        'status' => 'boolean',
        'price' => 'decimal:2',

    ];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}