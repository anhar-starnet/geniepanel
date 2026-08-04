<?php

namespace App\Services\GenieACS;

class DeviceProvisioning
{
    public function __construct(
        protected DeviceRepository $repository
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