<?php

namespace App\Repositories;

use App\Models\DeviceHistory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DeviceHistoryRepository
{
    /**
     * Total snapshot hari ini.
     */
    public function todayCount(): int
    {
        return DeviceHistory::today()->count();
    }

    /**
     * Trend online per jam (24 jam).
     */
    public function onlineTrend(): Collection
{
    return DeviceHistory::selectRaw("
            DATE_FORMAT(created_at,'%Y-%m-%d %H:00') as hour,
            SUM(CASE WHEN online = 1 THEN 1 ELSE 0 END) as total
        ")
        ->where('created_at', '>=', now()->subDay())
        ->groupByRaw("DATE_FORMAT(created_at,'%Y-%m-%d %H:00')")
        ->orderByRaw("MIN(created_at)")
        ->get();
}

    /**
     * Trend offline per jam.
     */
    public function offlineTrend(): Collection
{
    return DeviceHistory::selectRaw("
            DATE_FORMAT(created_at,'%Y-%m-%d %H:00') as hour,
            SUM(CASE WHEN online = 0 THEN 1 ELSE 0 END) as total
        ")
        ->where('created_at', '>=', now()->subDay())
        ->groupByRaw("DATE_FORMAT(created_at,'%Y-%m-%d %H:00')")
        ->orderByRaw("MIN(created_at)")
        ->get();
}

    /**
     * RX Critical.
     */
    public function rxCritical(): Collection
    {
        return DeviceHistory::where('rx_power', '<', -30)
            ->latest()
            ->limit(20)
            ->get();
    }

    /**
     * Temperature Critical.
     */
    public function temperatureCritical(): Collection
    {
        return DeviceHistory::where('temperature', '>=', 80)
            ->latest()
            ->limit(20)
            ->get();
    }

    /**
     * Top ONU sering offline.
     */
    public function topOfflineDevices(int $limit = 10): Collection
    {
        return DeviceHistory::select(
                'serial_number',
                DB::raw('COUNT(*) as total')
            )
            ->where('online', false)
            ->groupBy('serial_number')
            ->orderByDesc('total')
            ->limit($limit)
            ->get();
    }

    /**
 * Query snapshot terakhir setiap device.
 */
protected function latestDevices()
{
    return DeviceHistory::query()
        ->whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('device_history')
                ->groupBy('serial_number');
        });
}

    /**
     * Ringkasan dashboard.
     */
    public function summary(): array
{
    $latest = $this->latestDevices();

    return [

        'today' => (clone $latest)->count(),

        'online' => (clone $latest)
            ->where('online', true)
            ->count(),

        'offline' => (clone $latest)
            ->where('online', false)
            ->count(),

        'rxCritical' => (clone $latest)
            ->where('rx_power', '<', -30)
            ->count(),

        'tempCritical' => (clone $latest)
            ->where('temperature', '>=', 80)
            ->count(),

    ];
}

}