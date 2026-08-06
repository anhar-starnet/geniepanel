<?php

namespace App\Services\Diagnostics;

use App\Models\DeviceHistory;
use Carbon\Carbon;

class OfflineAnalyzer
{
    /**
     * Analisa penyebab status device.
     */
    public function analyze(DeviceHistory $history): array
    {
        /*
         |---------------------------------------------------------
         | ONLINE
         |---------------------------------------------------------
         */

        if ($history->online) {

            return [
                'code'       => 'online',
                'label'      => 'Online',
                'icon'       => '🟢',
                'confidence' => 100,
            ];
        }

        /*
         |---------------------------------------------------------
         | Last Inform
         |---------------------------------------------------------
         */

        if (!$history->last_inform) {

            return [
                'code'       => 'power_down',
                'label'      => 'Power Down',
                'icon'       => '⚡',
                'confidence' => 90,
            ];
        }

        $minutes = Carbon::parse($history->last_inform)
            ->diffInMinutes(now());

        /*
         |---------------------------------------------------------
         | > 60 menit
         |---------------------------------------------------------
         */

        if ($minutes >= 60) {

            return [
                'code'       => 'power_down',
                'label'      => 'Power Down',
                'icon'       => '⚡',
                'confidence' => 95,
            ];
        }

        /*
         |---------------------------------------------------------
         | 10-60 menit
         |---------------------------------------------------------
         */

        if ($minutes >= 10) {

            return [
                'code'       => 'tr069_timeout',
                'label'      => 'TR-069 Timeout',
                'icon'       => '📡',
                'confidence' => 80,
            ];
        }

        /*
         |---------------------------------------------------------
         | Default
         |---------------------------------------------------------
         */

        return [
            'code'       => 'unknown',
            'label'      => 'Unknown',
            'icon'       => '❓',
            'confidence' => 50,
        ];
    }
}