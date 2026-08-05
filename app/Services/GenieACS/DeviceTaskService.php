<?php

namespace App\Services\GenieACS;

class DeviceTaskService
{
    public function __construct(
        protected GenieACSClient $client
    ) {
    }

    /**
     * Ambil daftar task sebuah device.
     */
    public function history(
        string $deviceId
    ): array {

        return $this->client->tasks(
            $deviceId
        );

    }
}