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
    $online = $this->history->onlineTrend();

    $offline = $this->history->offlineTrend();

    return [

        'summary' => $this->history->summary(),

        'charts' => [

            'labels' => $online->pluck('hour'),

            'online' => $online->pluck('total'),

            'offline' => $offline->pluck('total'),

        ],

        'alarm' => [

            'rxCritical' => $this->history->rxCritical(),

            'temperatureCritical' => $this->history->temperatureCritical(),

        ],

        'today' => $this->history->todayCount(),

        'topOffline' => $this->history->topOfflineDevices(),

    ];
}

}