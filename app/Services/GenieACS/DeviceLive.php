<?php

namespace App\Services\GenieACS;

use App\Models\Customer;
use Carbon\Carbon;

class DeviceLive
{
    public function __construct(
        protected DeviceMatcher $matcher
    ) {
    }

    /**
     * Ambil data Live berdasarkan Customer.
     */
    public function customer(Customer $customer): ?array
    {
        $device = null;

        /*
        |--------------------------------------------------------------------------
        | Prioritas 1
        | GenieACS Device ID
        |--------------------------------------------------------------------------
        */

        if (
            $customer->ont &&
            !empty($customer->ont->genieacs_device_id)
        ) {
            $device = $this->matcher->byId(
                $customer->ont->genieacs_device_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Prioritas 2
        | Serial Number
        |--------------------------------------------------------------------------
        */

        if (
            !$device &&
            $customer->ont &&
            !empty($customer->ont->serial_number)
        ) {
            $device = $this->matcher->bySerial(
                $customer->ont->serial_number
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Prioritas 3
        | PPPoE Username (Fallback)
        |--------------------------------------------------------------------------
        */

        if (
            !$device &&
            !empty($customer->pppoe_username)
        ) {
            $device = $this->matcher->byPPPoE(
                $customer->pppoe_username
            );
        }

        if (!$device) {
            return null;
        }

        return $this->transform($device);
    }

    /**
     * Ambil data Live dari DeviceDTO.
     */
    public function device(DeviceDTO $device): array
    {
        return $this->transform($device);
    }

    /**
     * Konversi DeviceDTO ke array siap View.
     */
    protected function transform(DeviceDTO $device): array
    {
        return [

            'device' => $device,

            'online' => $device->isOnline(),

            'onlineLabel' => $device->onlineLabel(),

            'onlineBadge' => $device->onlineBadgeClass(),

            'manufacturer' => $device->manufacturer,

            'productClass' => $device->productClass,

            'serialNumber' => $device->serialNumber,

            'firmware' => $device->firmware,

            'pppoeUsername' => $device->pppoeUsername,

            'pppoeIP' => $device->pppoeIP,

            'rx' => $device->rxPower,

            'rxStatus' => $device->rxStatus(),

            'rxBadge' => $device->rxBadgeClass(),

            'rxPercent' => $device->rxPercentage(),

            'rxColor' => $this->rxColor(
                $device->rxPower
            ),

            'temperature' => $device->temperature,

            'temperatureStatus' => $device->temperatureStatus(),

            'temperatureBadge' => $device->temperatureBadgeClass(),

            'uptime' => $device->uptime,

            'lastInform' => $this->formatLastInform(
                $device->lastInform
            ),

            'lastInformBadge' => $device->lastInformBadgeClass(),

            'lastInformRaw' => $device->lastInform,

            'healthScore' => $device->healthScore(),

            'healthStatus' => $device->healthStatus(),

            'healthBadge' => $device->healthBadgeClass(),

        ];
    }

    /**
     * Warna indikator RX.
     */
    protected function rxColor(?string $rx): string
    {
        if (!$rx) {
            return 'secondary';
        }

        $rx = (float) $rx;

        return match (true) {

            $rx >= -18 => 'primary',

            $rx >= -24 => 'success',

            $rx >= -27 => 'warning',

            default => 'danger',

        };
    }

    /**
     * Format Last Inform.
     */
    protected function formatLastInform(?string $time): string
    {
        if (!$time) {
            return '-';
        }

        return Carbon::parse($time)
            ->diffForHumans();
    }
}