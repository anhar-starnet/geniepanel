<?php

namespace App\Services\GenieACS;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Models\DeviceHistory;
use Illuminate\Support\Collection;

class HistoryService
{
    protected Collection $latestHistory;
    public function __construct(
        protected DeviceRepository $devices
    ) {
    }

    protected function hasChanged(DeviceDTO $device): bool
{
    $last = $this->latestHistory->get(
    $device->serialNumber
);

if (!$last) {
    return true;
}
        'serial_number',
        $device->serialNumber
    )
    ->latest('id')
    ->first();

    if (!$last) {
        return true;
    }

    // Status online berubah
    if ($last->online != $device->isOnline()) {
        return true;
    }

    // RX berubah >= 0.5 dBm
    if (abs($last->rx_power - $device->rxValue()) >= 0.5) {
        return true;
    }

    // Temperature berubah >= 1°C
    if (abs($last->temperature - $device->temperatureValue()) >= 1) {
        return true;
    }

    // IP PPPoE berubah
    if ($last->pppoe_ip != $device->pppoeIP) {
        return true;
    }

    return false;
}

    /**
     * Collect seluruh device.
     */
    public function collect(): int
{
    $this->latestHistory = DeviceHistory::query()
    ->select(
        'serial_number',
        'online',
        'rx_power',
        'temperature',
        'pppoe_ip'
    )
    ->whereIn('id', function ($query) {
        $query->selectRaw('MAX(id)')
            ->from('device_history')
            ->groupBy('serial_number');
    })
    ->get()
    ->keyBy('serial_number');
    $rows = [];

    foreach ($this->devices->matched() as $row) {

        $device = $row->device;

        if ($this->hasChanged($device)) {
    $rows[] = $this->buildRow($device);
}

        if (count($rows) >= 500) {
            DeviceHistory::insert($rows);
            $rows = [];
        }
    }

    if (! empty($rows)) {
        DeviceHistory::insert($rows);
    }

    return $this->devices->matched()->count();
}

    protected function buildRow(DeviceDTO $device): array
{
    return [

        'device_id'       => $device->id,

        'serial_number'   => $device->serialNumber,

        'manufacturer'    => $device->manufacturer,

        'product_class'   => $device->productClass,

        'online'          => $device->isOnline(),

        'rx_power'        => $device->rxValue(),

        'temperature'     => $device->temperatureValue(),

        'uptime'          => $device->uptime,

        'pppoe_username'  => $device->pppoeUsername,

        'pppoe_ip'        => $device->pppoeIP,

        'last_inform' => $device->lastInform
            ? \Carbon\Carbon::parse($device->lastInform)
                ->setTimezone(config('app.timezone'))
                ->toDateTimeString()
            : null,

        'created_at' => now(),

        'updated_at' => now(),

    ];
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