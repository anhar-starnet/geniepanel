<?php

namespace App\Services\GenieACS;

use App\Models\DeviceHistory;
use App\Repositories\DeviceEventRepository;

class EventDetector
{
    public function __construct(
        protected DeviceEventRepository $events
    ) {
    }

    /**
     * Hanya event penting untuk NOC.
     */
    public function detect(DeviceHistory $old, array $new): void
    {
        \Log::info('EVENT DETECTOR CALLED', [
    'serial' => $new['serial_number'] ?? null,
]);

        $this->detectOnlineStatus($old, $new);
        $this->detectRxPower($old, $new);
        $this->detectTemperature($old, $new);
        $this->detectUptime($old, $new);

        // detectPppoeIp() sengaja dihapus
        // karena perubahan IP PPPoE bukan incident.
    }

    /**
     * Online / Offline.
     */
    protected function detectOnlineStatus(DeviceHistory $old, array $new): void
    {
        if ((bool) $old->online === (bool) $new['online']) {
            return;
        }

        \Log::info('ONLINE EVENT CREATED', [
    'old' => $old->online,
    'new' => $new['online'],
]);

        $this->events->create([
            'device_id'       => $new['device_id'],
            'serial_number'   => $new['serial_number'],
            'pppoe_username'  => $new['pppoe_username'] ?? null,

            'event' => $new['online']
                ? 'online'
                : 'offline',

            'reason' => $new['online']
                ? 'recovered'
                : 'offline',

            'severity' => $new['online']
                ? 'success'
                : 'critical',

            'confidence' => 100,

            'old_value' => $old->online
                ? 'online'
                : 'offline',

            'new_value' => $new['online']
                ? 'online'
                : 'offline',

            'message' => $new['online']
                ? 'ONU kembali online'
                : 'ONU menjadi offline',

            'created_at' => now(),
        ]);
    }
        /**
     * RX Critical.
     */
    protected function detectRxPower(DeviceHistory $old, array $new): void
    {
        if (
            (float) $old->rx_power >= -30 &&
            (float) $new['rx_power'] < -30
        ) {

            $this->events->create([

                'device_id'       => $new['device_id'],

                'serial_number'   => $new['serial_number'],

                'pppoe_username'  => $new['pppoe_username'] ?? null,

                'event'           => 'rx_critical',

                'reason'          => 'rx_critical',

                'severity'        => 'warning',

                'confidence'      => 95,

                'old_value'       => (string) $old->rx_power,

                'new_value'       => (string) $new['rx_power'],

                'message'         => sprintf(
                    'RX Critical (%.2f dBm)',
                    $new['rx_power']
                ),

                'created_at'      => now(),

            ]);
        }
    }

    /**
     * Temperature Critical.
     */
    protected function detectTemperature(DeviceHistory $old, array $new): void
    {
        if (
            (float) $old->temperature < 80 &&
            (float) $new['temperature'] >= 80
        ) {

            $this->events->create([

                'device_id'       => $new['device_id'],

                'serial_number'   => $new['serial_number'],

                'pppoe_username'  => $new['pppoe_username'] ?? null,

                'event'           => 'temperature',

                'reason'          => 'temperature',

                'severity'        => 'warning',

                'confidence'      => 95,

                'old_value'       => (string) $old->temperature,

                'new_value'       => (string) $new['temperature'],

                'message'         => sprintf(
                    'Temperature Critical (%s °C)',
                    $new['temperature']
                ),

                'created_at'      => now(),

            ]);
        }
    }

    /**
     * ONU Reboot.
     */
    protected function detectUptime(DeviceHistory $old, array $new): void
    {
        if (
            empty($old->uptime) ||
            empty($new['uptime'])
        ) {
            return;
        }

        /*
         |---------------------------------------------------------
         | Uptime lebih pendek = reboot
         |---------------------------------------------------------
         */

        if (
            $old->uptime !== $new['uptime'] &&
            strlen($new['uptime']) < strlen($old->uptime)
        ) {

            $this->events->create([

                'device_id'       => $new['device_id'],

                'serial_number'   => $new['serial_number'],

                'pppoe_username'  => $new['pppoe_username'] ?? null,

                'event'           => 'reboot',

                'reason'          => 'reboot',

                'severity'        => 'info',

                'confidence'      => 100,

                'old_value'       => $old->uptime,

                'new_value'       => $new['uptime'],

                'message'         => 'ONU Reboot Detected',

                'created_at'      => now(),

            ]);
        }

    }

}