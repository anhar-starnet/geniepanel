<?php

namespace App\Repositories;

use App\Models\DeviceEvent;
use Illuminate\Support\Collection;

class DeviceEventRepository
{
    /**
     * Ambil event terbaru.
     */
    public function latest(int $limit = 20): Collection
    {
        return DeviceEvent::query()
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Simpan event baru.
     */
    public function create(array $data): DeviceEvent
    {
        return DeviceEvent::create($data);
    }

    /**
     * Jumlah event hari ini.
     */
    public function todayCount(): int
    {
        return DeviceEvent::query()
            ->whereDate('created_at', today())
            ->count();
    }

    /**
     * Ambil event berdasarkan serial number.
     */
    public function bySerial(string $serial, int $limit = 100): Collection
    {
        return DeviceEvent::query()
            ->where('serial_number', $serial)
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Hapus event lama.
     */
    public function cleanup(int $days = 90): int
    {
        return DeviceEvent::query()
            ->where('created_at', '<', now()->subDays($days))
            ->delete();
    }
}