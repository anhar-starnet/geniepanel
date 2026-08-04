<?php

namespace App\Services\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class SuspendCustomer
{
    public function handle(Customer $customer): void
    {
        DB::transaction(function () use ($customer) {

            $customer->update([

                'status' => 'suspend',

            ]);

            /*
            |--------------------------------------------------------------------------
            | Sprint Berikutnya
            |--------------------------------------------------------------------------
            |
            | Disable PPPoE MikroTik
            | Disable Hotspot
            | Disable Static Route
            | Suspend Billing
            | Tulis Timeline
            |
            */

        });
    }
}