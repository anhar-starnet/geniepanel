<?php

namespace App\Services\GenieACS;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class DeviceRepository
{
    public function __construct(
        protected GenieACSClient $client
    ) {
    }

    /**
     * Ambil seluruh device dari GenieACS
     * Disimpan cache selama 60 detik.
     */
    public function all(): Collection
    {
        return Cache::remember(
            'genieacs.devices',
            now()->addSeconds(60),
            function () {

                return collect(
                    $this->client->devices()
                );

            }
        );
    }

    /**
     * Device berdasarkan Serial Number
     */
    public function findBySerial(
        string $serial
    ): ?DeviceDTO {

        return $this->all()

            ->first(
                fn ($device) =>
                    $device->serialNumber === $serial
            );

    }

    /**
     * Device berdasarkan Username PPPoE
     */
    public function findByPPPoE(
        string $username
    ): ?DeviceDTO {

        return $this->all()

            ->first(
                fn ($device) =>
                    $device->pppoeUsername === $username
            );

    }

    /**
     * Device yang sudah mempunyai customer
     */
    public function assigned(): Collection
    {
        return $this->all()

            ->map(function ($device) {

                $customer = Customer::where(
                    'pppoe_username',
                    $device->pppoeUsername
                )->first();

                return (object) [

                    'device' => $device,

                    'customer' => $customer,

                    'assigned' => $customer !== null,

                ];

            })

            ->filter(
                fn ($row) => $row->assigned
            )

            ->values();
    }

    /**
     * Device yang belum mempunyai customer
     */
    public function unassigned(): Collection
    {
        return $this->all()

            ->map(function ($device) {

                $customer = Customer::where(
                    'pppoe_username',
                    $device->pppoeUsername
                )->first();

                return (object) [

                    'device' => $device,

                    'customer' => $customer,

                    'assigned' => $customer !== null,

                ];

            })

            ->reject(
                fn ($row) => $row->assigned
            )

            ->values();
    }

    /**
     * Statistik Dashboard
     */
    public function statistics(): array
    {
        $devices = $this->all();

        return [

            'total' => $devices->count(),

            'online' => $devices->filter(
                fn ($d) => $d->isOnline()
            )->count(),

            'offline' => $devices->reject(
                fn ($d) => $d->isOnline()
            )->count(),

            'assigned' => $this->assigned()->count(),

            'unassigned' => $this->unassigned()->count(),

        ];
    }

    /**
     * Hapus cache manual
     */
    public function clearCache(): void
    {
        Cache::forget(
            'genieacs.devices'
        );
    }
}