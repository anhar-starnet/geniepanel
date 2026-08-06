<?php

namespace App\Services\History;

use App\Models\DeviceHistory;
use App\Services\GenieACS\DeviceDTO;

class HistoryComparator
{
    /**
     * Menentukan apakah snapshot berubah.
     */
    public function hasChanged(
        ?DeviceHistory $last,
        DeviceDTO $device
    ): bool {

        if (!$last) {
            return true;
        }

        if ((bool) $last->online !== $device->isOnline()) {
            return true;
        }

        if (
            abs(
                (float) $last->rx_power -
                (float) $device->rxValue()
            ) >= 0.5
        ) {
            return true;
        }

        if (
            abs(
                (float) $last->temperature -
                (float) $device->temperatureValue()
            ) >= 1
        ) {
            return true;
        }

        if (
            (string) $last->pppoe_ip !==
            (string) $device->pppoeIP
        ) {
            return true;
        }

        if (
            (string) $last->uptime !==
            (string) $device->uptime
        ) {
            return true;
        }

        return false;
    }
}