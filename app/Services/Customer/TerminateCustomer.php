<?php

namespace App\Services\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class TerminateCustomer
{
    public function handle(Customer $customer): void
    {
        DB::transaction(function () use ($customer) {

            $customer->update([

                'status' => 'terminated',

            ]);

            /*
            |--------------------------------------------------------------------------
            | Sprint Berikutnya
            |--------------------------------------------------------------------------
            |
            | Release ONT
            | Release Splitter Port
            | Delete PPPoE
            | Delete Hotspot
            | Billing
            | Timeline
            |
            */

        });
    }
}