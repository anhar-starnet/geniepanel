<?php

namespace App\Services\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class ResumeCustomer
{
    public function handle(Customer $customer): void
    {
        DB::transaction(function () use ($customer) {

            $customer->update([

                'status' => 'active',

            ]);

            /*
            |--------------------------------------------------------------------------
            | Sprint Berikutnya
            |--------------------------------------------------------------------------
            |
            | Enable MikroTik
            | Enable Hotspot
            | Enable Static
            | Billing
            | Timeline
            |
            */

        });
    }
}