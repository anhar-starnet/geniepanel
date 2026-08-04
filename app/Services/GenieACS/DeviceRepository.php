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
 * Ambil seluruh device dari GenieACS.
 */
public function all(): Collection
{
    return collect(
        $this->client->devices()
    );
}

    /**
     * Ambil index customer berdasarkan PPPoE Username.
     */
    private function customerIndex(): Collection
{
    return Customer::query()
        ->select([
            'id',
            'name',
            'customer_code',
            'pppoe_username',
            'status',
            'ont_id',
        ])
        ->get()
        ->keyBy('pppoe_username');
}

    /**
     * Match device dengan customer.
     */
    private function mapDevice(DeviceDTO $device): object
    {
        $customer = $this->customerIndex()->get(
            $device->pppoeUsername
        );

        return (object) [
            'device' => $device,
            'customer' => $customer,
            'assigned' => $customer !== null,
        ];
    }

    /**
     * Cari device berdasarkan serial number.
     */
    public function findBySerial(
        string $serial
    ): ?DeviceDTO {

        return $this->all()->first(
            fn (DeviceDTO $device) =>
                $device->serialNumber === $serial
        );
    }
    /**
 * Cari device berdasarkan GenieACS Device ID.
 */
public function findById(
    string $deviceId
): ?DeviceDTO {

    return $this->all()->first(
        fn (DeviceDTO $device) =>
            $device->id === $deviceId
    );
}

    /**
     * Cari device berdasarkan username PPPoE.
     */
    public function findByPPPoE(
        string $username
    ): ?DeviceDTO {

        return $this->all()->first(
            fn (DeviceDTO $device) =>
                $device->pppoeUsername === $username
        );
    }

    /**
     * Seluruh device yang sudah mempunyai customer.
     */
    public function assigned(): Collection
    {
        return $this->all()
            ->map(
                fn (DeviceDTO $device) =>
                    $this->mapDevice($device)
            )
            ->filter(
                fn ($row) => $row->assigned
            )
            ->values();
    }

    /**
     * Seluruh device yang belum mempunyai customer.
     */
    public function unassigned(): Collection
    {
        return $this->all()
            ->map(
                fn (DeviceDTO $device) =>
                    $this->mapDevice($device)
            )
            ->reject(
                fn ($row) => $row->assigned
            )
            ->values();
    }

    /**
     * Semua device beserta status assignment.
     */
    public function matched(): Collection
    {
        return $this->all()
            ->map(
                fn (DeviceDTO $device) =>
                    $this->mapDevice($device)
            )
            ->values();
    }

    /**
     * Statistik dashboard.
     */
    public function statistics(): array
    {
        $matched = $this->matched();

        return [

            'total' => $matched->count(),

            'online' => $matched
                ->filter(
                    fn ($row) =>
                        $row->device->isOnline()
                )
                ->count(),

            'offline' => $matched
                ->reject(
                    fn ($row) =>
                        $row->device->isOnline()
                )
                ->count(),

            'assigned' => $matched
                ->where('assigned', true)
                ->count(),

            'unassigned' => $matched
                ->where('assigned', false)
                ->count(),

        ];
    }

    /**
     * Hapus seluruh cache GenieACS.
     */
    public function clearCache(): void
    {
        Cache::forget('genieacs.devices');
        Cache::forget('genieacs.customer.index');
    }
}