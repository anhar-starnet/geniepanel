<?php

namespace App\Services\Customer;

use App\Models\Customer;
use App\Services\GenieACS\GenieACSClient;

class Customer360Service
{
    public function __construct(
        protected GenieACSClient $genieACS
    ) {
    }

    /**
     * Customer 360
     */
    public function load(Customer $customer): array
    {
        $customer->loadMissing([
            'package',
            'ont',
            'ont.splitterPort',
            'ont.splitterPort.splitter',
            'ont.splitterPort.splitter.odp',
            'ont.splitterPort.splitter.odp.pop',
            'ont.splitterPort.splitter.odp.pop.area',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Cari Serial Number
        |--------------------------------------------------------------------------
        */

        $serialNumber = null;

        if (!empty($customer->serial_number)) {

            $serialNumber = $customer->serial_number;

        } elseif ($customer->ont?->serial_number) {

            $serialNumber = $customer->ont->serial_number;

        }

        /*
        |--------------------------------------------------------------------------
        | Ambil Device dari GenieACS
        |--------------------------------------------------------------------------
        */

        $device = null;

        if ($serialNumber) {

            $device = $this->genieACS
                ->findBySerial($serialNumber);

        }

        return [

            'customer' => $customer,

            'device' => $device,

            'serialNumber' => $serialNumber,

        ];
    }
}