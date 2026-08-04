<?php

namespace App\Services\GenieACS;

use App\Models\Customer;
use Illuminate\Support\Collection;

class DeviceMatcher
{
    public function __construct(
        protected DeviceRepository $repository
    ) {
    }

    /**
     * Semua device beserta status customer.
     */
    public function all(): Collection
    {
        return $this->repository->matched();
    }

    /**
     * Device yang sudah mempunyai customer.
     */
    public function assigned(): Collection
    {
        return $this->repository->assigned();
    }

    /**
     * Device yang belum mempunyai customer.
     */
    public function unassigned(): Collection
    {
        return $this->repository->unassigned();
    }

    /**
     * Cari customer berdasarkan Device.
     */
    public function customer(DeviceDTO $device): ?Customer
    {
        return Customer::query()

            ->with([

                'package',

                'ont.splitterPort.splitter.odp.pop.area',

                'pop',

                'odp',

            ])

            ->where(
                'pppoe_username',
                $device->pppoeUsername
            )

            ->first();
    }

    /**
     * Apakah device sudah mempunyai customer.
     */
    public function isAssigned(
        DeviceDTO $device
    ): bool {

        return $this->customer($device) !== null;
    }

    /**
     * Device orphan
     * (belum mempunyai customer).
     */
    public function orphanDevices(): Collection
    {
        return $this->unassigned()

            ->map(
                fn ($row) => $row->device
            )

            ->values();
    }

    /**
     * Duplicate PPPoE Username
     * pada database customer.
     */
    public function duplicateCustomers(): Collection
    {
        return Customer::query()

            ->select('pppoe_username')

            ->whereNotNull('pppoe_username')

            ->groupBy('pppoe_username')

            ->havingRaw('COUNT(*) > 1')

            ->pluck('pppoe_username');
    }

    /**
     * Device yang menggunakan
     * PPPoE duplicate.
     */
    public function duplicateDevices(): Collection
    {
        $duplicates = $this->duplicateCustomers();

        return $this->repository
            ->all()

            ->filter(function (
                DeviceDTO $device
            ) use (
                $duplicates
            ) {

                return $duplicates->contains(
                    $device->pppoeUsername
                );

            })

            ->values();
    }

    /**
     * Cari device berdasarkan serial.
     */
    public function bySerial(
        string $serial
    ): ?DeviceDTO {

        return $this->repository
            ->findBySerial($serial);
    }

    /**
     * Cari device berdasarkan PPPoE.
     */
    public function byPPPoE(
        string $username
    ): ?DeviceDTO {

        return $this->repository
            ->findByPPPoE($username);
    }

    /**
     * Statistik Device.
     */
    public function statistics(): array
    {
        $stats = $this->repository
            ->statistics();

        $stats['duplicate'] = $this
            ->duplicateDevices()
            ->count();

        $stats['orphan'] = $this
            ->orphanDevices()
            ->count();

        return $stats;
    }
}