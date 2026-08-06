<?php

namespace App\Services\GenieACS;

use App\Models\DeviceHistory;
use App\Services\History\HistoryComparator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Services\History\HistoryWriter;

class HistoryService
{
    protected Collection $latestHistory;

    public function __construct(
        protected DeviceRepository $devices,
        protected EventDetector $detector,
        protected HistoryComparator $comparator,
        protected HistoryWriter $writer,

    ) {
    }

    /**
     * Collect seluruh device.
     */
    public function collect(): int
    {
        $this->latestHistory = DeviceHistory::query()
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('device_history')
                    ->groupBy('serial_number');
            })
            ->get()
            ->keyBy('serial_number');

        $rows = [];

        foreach ($this->devices->matched() as $item) {

            $device = $item->device;

            $last = $this->latestHistory->get($device->serialNumber);

            if (! $this->comparator->hasChanged($last, $device)) {
                continue;
            }

            $row = $this->buildRow($device);

            if ($last) {
                $this->detector->detect($last, $row);
            }

            $rows[] = $row;

            if (count($rows) >= 500) {
    $this->writer->insert($rows);
}
        }

        $this->writer->insert($rows);

        return $this->devices->matched()->count();
    }

    /**
     * Build snapshot.
     */
    protected function buildRow(DeviceDTO $device): array
    {
        return [

            'device_id'      => $device->id,

            'serial_number'  => $device->serialNumber,

            'manufacturer'   => $device->manufacturer,

            'product_class'  => $device->productClass,

            'online'         => $device->isOnline(),

            'rx_power'       => $device->rxValue(),

            'temperature'    => $device->temperatureValue(),

            'uptime'         => $device->uptime,

            'pppoe_username' => $device->pppoeUsername,

            'pppoe_ip'       => $device->pppoeIP,

            'last_inform'    => $device->lastInform
                ? \Carbon\Carbon::parse($device->lastInform)
                    ->setTimezone(config('app.timezone'))
                    ->toDateTimeString()
                : null,

            'created_at'     => now(),

            'updated_at'     => now(),
        ];
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
     * Bersihkan history lama.
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
    public function history(
        string $serial,
        int $limit = 100
    ): Collection {
        return DB::table('device_history')
            ->where('serial_number', $serial)
            ->latest()
            ->limit($limit)
            ->get();
    }
}