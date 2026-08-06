<?php

namespace App\Services\GenieACS;

use App\Models\DeviceHistory;
use App\Repositories\DeviceEventRepository;

class EventDetector
{
    public function __construct(
        protected DeviceEventRepository $events
    ) {}

    /**
     * Bandingkan snapshot lama dengan snapshot baru.
     */
    public function detect(DeviceHistory $old, array $new): void
    {
        $this->detectOnlineStatus($old, $new);
        $this->detectRxPower($old, $new);
        $this->detectTemperature($old, $new);
        $this->detectPppoeIp($old, $new);
        $this->detectUptime($old, $new);
    }

    protected function detectOnlineStatus(DeviceHistory $old, array $new): void
    {
        if ((bool)$old->online === (bool)$new['online']) {
            return;
        }

        $this->events->create([
            'device_id'     => $new['device_id'],
            'serial_number' => $new['serial_number'],
            'event'         => $new['online'] ? 'online' : 'offline',
            'old_value'     => $old->online ? 'online' : 'offline',
            'new_value'     => $new['online'] ? 'online' : 'offline',
            'message'       => $new['online']
                ? 'ONU kembali online'
                : 'ONU menjadi offline',
            'created_at'    => now(),
        ]);
    }

    protected function detectRxPower(DeviceHistory $old, array $new): void
    {
        if ($old->rx_power >= -30 && $new['rx_power'] < -30) {

            $this->events->create([
                'device_id'     => $new['device_id'],
                'serial_number' => $new['serial_number'],
                'event'         => 'rx_critical',
                'old_value'     => (string) $old->rx_power,
                'new_value'     => (string) $new['rx_power'],
                'message'       => 'RX Power Critical',
                'created_at'    => now(),
            ]);
        }
    }

    protected function detectTemperature(DeviceHistory $old, array $new): void
    {
        if ($old->temperature < 80 && $new['temperature'] >= 80) {

            $this->events->create([
                'device_id'     => $new['device_id'],
                'serial_number' => $new['serial_number'],
                'event'         => 'temperature',
                'old_value'     => (string) $old->temperature,
                'new_value'     => (string) $new['temperature'],
                'message'       => 'Temperature Critical',
                'created_at'    => now(),
            ]);
        }
    }

    protected function detectPppoeIp(DeviceHistory $old, array $new): void
    {
        if ($old->pppoe_ip === $new['pppoe_ip']) {
            return;
        }

        $this->events->create([
            'device_id'     => $new['device_id'],
            'serial_number' => $new['serial_number'],
            'event'         => 'pppoe_ip',
            'old_value'     => (string) $old->pppoe_ip,
            'new_value'     => (string) $new['pppoe_ip'],
            'message'       => 'PPPoE IP Changed',
            'created_at'    => now(),
        ]);
    }

    protected function detectUptime(DeviceHistory $old, array $new): void
    {
        if (empty($old->uptime) || empty($new['uptime'])) {
            return;
        }

        if ($old->uptime !== $new['uptime'] && strlen($new['uptime']) < strlen($old->uptime)) {

            $this->events->create([
                'device_id'     => $new['device_id'],
                'serial_number' => $new['serial_number'],
                'event'         => 'reboot',
                'old_value'     => $old->uptime,
                'new_value'     => $new['uptime'],
                'message'       => 'ONU Reboot Detected',
                'created_at'    => now(),
            ]);
        }
    }
}