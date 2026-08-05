<?php

namespace App\Services\GenieACS;

class DeviceProvisioning
{
    public function __construct(
        protected DeviceRepository $repository,
        protected GenieACSClient $client,
    ) {
    }

    /**
     * Menyiapkan data Device
     * untuk proses Create Customer.
     */
    public function prepare(string $deviceId): array
    {
        $device = $this->repository
            ->all()
            ->firstWhere('id', $deviceId);

        if (!$device) {
            return [];
        }

        return [

            'device_id' => $device->id,

            'serial_number' => $device->serialNumber,

            'pppoe_username' => $device->pppoeUsername,

            'manufacturer' => $device->manufacturer,

            'product_class' => $device->productClass,

            'firmware' => $device->firmware,

            'hardware' => $device->hardware,

        ];
    }

    /**
     * Cek apakah Device ada.
     */
    public function exists(string $deviceId): bool
    {
        return $this->repository
            ->all()
            ->contains(
                fn (DeviceDTO $device) =>
                    $device->id === $deviceId
            );
    }

    /**
 * Kirim task Refresh ke GenieACS.
 */
public function refresh(
    string $deviceId
): array {

    $this->ensureExists($deviceId);

    return $this->client->refresh(
        $deviceId
    );
}

/**
 * Kirim task Reboot ke GenieACS.
 */
public function reboot(
    string $deviceId
): array {

    $this->ensureExists($deviceId);

    return $this->client->reboot(
        $deviceId
    );
}


    private function ensureExists(string $deviceId): void
    {
        if (! $this->exists($deviceId)) {
            throw new \InvalidArgumentException('Device tidak ditemukan.');
        }
    }


    /**
     * Ambil DeviceDTO.
     */
    public function device(string $deviceId): ?DeviceDTO
    {
        return $this->repository
            ->all()
            ->firstWhere(
                'id',
                $deviceId
            );
    }
}