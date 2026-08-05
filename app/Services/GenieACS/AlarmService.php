<?php

namespace App\Services\GenieACS;

use Illuminate\Support\Collection;

class AlarmService
{
    public function __construct(
        protected DeviceRepository $devices
    ) {
    }

    public function offlineDevices(): Collection
    {
        return $this->devices->offline();
    }

    public function rxWarning(): Collection
    {
        return $this->devices->matched()
            ->filter(fn ($row) =>
                $row->device->rxValue() < -27 &&
                $row->device->rxValue() >= -30
            )->values();
    }

    public function rxCritical(): Collection
    {
        return $this->devices->matched()
            ->filter(fn ($row) => $row->device->rxValue() < -30)
            ->values();
    }

    public function temperatureWarning(): Collection
    {
        return $this->devices->matched()
            ->filter(fn ($row) =>
                $row->device->temperatureValue() >= 70 &&
                $row->device->temperatureValue() < 80
            )->values();
    }

    public function temperatureCritical(): Collection
    {
        return $this->devices->matched()
            ->filter(fn ($row) => $row->device->temperatureValue() >= 80)
            ->values();
    }

    public function summary(): array
    {
        return [
            'offline' => $this->offlineDevices()->count(),
            'rx_warning' => $this->rxWarning()->count(),
            'rx_critical' => $this->rxCritical()->count(),
            'temp_warning' => $this->temperatureWarning()->count(),
            'temp_critical' => $this->temperatureCritical()->count(),
        ];
    }
}
