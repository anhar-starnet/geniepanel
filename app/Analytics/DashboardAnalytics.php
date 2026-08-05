<?php

namespace App\Analytics;

use App\Repositories\DeviceHistoryRepository;

class DashboardAnalytics
{
    public function __construct(
        protected DeviceHistoryRepository $history
    ) {
    }

    /**
     * Build seluruh data dashboard.
     */
    public function build(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Summary
            |--------------------------------------------------------------------------
            */

            'summary' => $this->history->summary(),

            /*
            |--------------------------------------------------------------------------
            | Chart
            |--------------------------------------------------------------------------
            */

            'charts' => [

                'online' => $this->history->onlineTrend(),

                'offline' => $this->history->offlineTrend(),

            ],

            /*
            |--------------------------------------------------------------------------
            | Alarm
            |--------------------------------------------------------------------------
            */

            'alarm' => [

                'rxCritical' => $this->history->rxCritical(),

                'temperatureCritical' => $this->history->temperatureCritical(),

            ],

            /*
            |--------------------------------------------------------------------------
            | History
            |--------------------------------------------------------------------------
            */

            'today' => $this->history->todayCount(),

            /*
            |--------------------------------------------------------------------------
            | Top Offline
            |--------------------------------------------------------------------------
            */

            'topOffline' =>

                $this->history->topOfflineDevices(),

        ];
    }
}