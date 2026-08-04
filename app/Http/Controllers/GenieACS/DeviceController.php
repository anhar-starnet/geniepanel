<?php

namespace App\Http\Controllers\GenieACS;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\GenieACS\GenieACSClient;
use Illuminate\View\View;

class DeviceController extends Controller
{
    public function __construct(
        protected GenieACSClient $genieACS
    ) {
    }

    /**
     * Daftar Device dari GenieACS
     */
    public function index(): View
    {
        $devices = collect(
            $this->genieACS->devices()
        )->map(function ($device) {

            $customer = Customer::where(
                'pppoe_username',
                $device->pppoeUsername
            )->first();

            return (object) [

                'device' => $device,

                'customer' => $customer,

                'assigned' => $customer !== null,

            ];

        });

        return view(
            'genieacs.devices.index',
            compact('devices')
        );
    }
}