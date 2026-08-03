<?php

declare(strict_types=1);

namespace App\Actions\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class ActivateCustomerAction
{
    /**
     * Aktivasi customer.
     *
     * @param Customer $customer
     * @param array<string, mixed> $data
     */
    public function execute(Customer $customer, array $data): Customer
    {
        return DB::transaction(function () use ($customer, $data) {

            $customer->update([

                'package_id'       => $data['package_id'],
                'ont_id'           => $data['ont_id'],
                'pppoe_username'   => $data['pppoe_username'],
                'pppoe_password'   => $data['pppoe_password'],
                'status'           => 'active',

            ]);

            return $customer->fresh();

        });
    }
}