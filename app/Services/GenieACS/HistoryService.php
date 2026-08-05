<?php

namespace App\Services\GenieACS;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class HistoryService
{
    public function __construct(
        protected DeviceRepository $devices
    ) {
    }

    /**
     * Collect seluruh device.
     */
    public function collect(): int
    {
        $count = 0;

        $this->devices
            ->matched()
            ->each(function ($row) use (&$count) {

                $this->collectDevice($row->device);

                $count++;

            });

        return $count;
    }

    /**
     * Simpan history satu device.
     */
    public function collectDevice(DeviceDTO $device): void
    {
        DB::table('device_history')->insert([

            'device_id'      => $device->id,
            'serial_number'  => $device->serialNumber,

            'manufacturer'   => $device->manufacturer,
            'product_class'  => $device->productClass,

            'online'         => $device->isOnline(),

            'rx_power'    => $device->rxValue(),
            'temperature' => $device->temperatureValue(),
            'uptime'      => $device->uptime,

            'pppoe_username' => $device->pppoeUsername,
            'pppoe_ip'       => $device->pppoeIP,

            'last_inform' => $device->lastInform
    ? Carbon::parse($device->lastInform)
        ->setTimezone(config('app.timezone'))
        ->toDateTimeString()
    : null,

            'created_at'     => now(),
            'updated_at'     => now(),

        ]);
    }

    /**
     * Statistik history.
     */
    public function statistics(): array
    {
        return [

            'today' => DB::table('device_history')
                ->whereDate('created_at', today())
                ->count(),

            'week' => DB::table('device_history')
                ->where('created_at', '>=', now()->subDays(7))
                ->count(),

            'month' => DB::table('device_history')
                ->where('created_at', '>=', now()->subDays(30))
                ->count(),

        ];
    }

    /**
     * Bersihkan data lama.
     */
    public function cleanup(int $days = 90): int
    {
        return DB::table('device_history')
            ->where(
                'created_at',
                '<',
                now()->subDays($days)
            )
            ->delete();
    }

    /**
     * History satu device.
     */
    public function history(string $serial, int $limit = 100): Collection
    {
        return DB::table('device_history')
            ->where('serial_number', $serial)
            ->latest()
            ->limit($limit)
            ->get();
    }
}