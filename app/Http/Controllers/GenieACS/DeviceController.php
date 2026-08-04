<?php

namespace App\Http\Controllers\GenieACS;

use App\Http\Controllers\Controller;
use App\Services\GenieACS\DeviceMatcher;
use App\Services\GenieACS\DeviceRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeviceController extends Controller
{
    public function __construct(
        protected DeviceRepository $repository,
        protected DeviceMatcher $matcher
    ) {
    }

    /**
     * Daftar seluruh device.
     */
    public function index(Request $request): View
    {
        $filter = $request->string('filter')->toString();

        $devices = match ($filter) {

            'assigned' => $this->matcher->assigned(),

            'unassigned' => $this->matcher->unassigned(),

            default => $this->matcher->all(),

        };

        return view(
            'genieacs.devices.index',
            [
                'devices' => $devices,
                'statistics' => $this->matcher->statistics(),
                'filter' => $filter,
            ]
        );
    }

    /**
     * Detail device.
     */
    public function show(string $serial): View
    {
        $device = $this->repository
            ->findBySerial($serial);

        abort_if(
            $device === null,
            404,
            'Device tidak ditemukan.'
        );

        return view(
            'genieacs.devices.show',
            [
                'device' => $device,
                'customer' => $this->matcher->customer($device),
            ]
        );
    }
}