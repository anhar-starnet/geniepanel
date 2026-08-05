<?php

namespace App\Services\GenieACS;

use Illuminate\Support\Facades\Http;

class GenieACSClient
{
    protected string $baseUrl;

    protected int $timeout;

    public function __construct()
    {
        $this->baseUrl = rtrim(
            config('services.genieacs.url'),
            '/'
        );

        $this->timeout = (int) config(
            'services.genieacs.timeout',
            10
        );
    }

    /**
     * GET Request
     */
    protected function get(
        string $endpoint,
        array $query = []
    ): array {

        $response = Http::timeout(
                $this->timeout
            )
            ->retry(2, 300)
            ->retry(2, 300)
            ->acceptJson()
            ->get(
                $this->baseUrl . $endpoint,
                $query
            );

        $response->throw();

        return $response->json() ?? [];
    }

    /**
     * POST Request
     */
    protected function post(
        string $endpoint,
        array $data = []
    ): array {

        $response = Http::timeout(
                $this->timeout
            )
            ->acceptJson()
            ->post(
                $this->baseUrl . $endpoint,
                $data
            );

        $response->throw();

        return $response->json() ?? [];
    }

    /**
     * Daftar Device
     */
    public function devices(): array
{
    $devices = $this->get('/devices', [

        'projection' => implode(
            ',',
            ProjectionBuilder::deviceList()
        ),

    ]);

    return collect($devices)

        ->map(fn ($device) => DeviceDTO::fromArray($device))

        ->all();
}

    /**
     * Detail Device
     */
    public function device(
        string $deviceId
    ): ?DeviceDTO {

        $data = $this->get('/devices', [

            'query' => json_encode([

                '_id' => $deviceId,

            ]),

            'projection' => implode(
                ',',
                ProjectionBuilder::deviceDetail()
            ),

        ]);

        if (empty($data)) {
            return null;
        }

        return DeviceDTO::fromArray(
            $data[0]
        );
    }

    /**
     * Cari berdasarkan Serial Number
     */
    public function findBySerial(
        string $serial
    ): ?DeviceDTO {

        $data = $this->get('/devices', [

            'query' => json_encode([

                '_deviceId._SerialNumber' => $serial,

            ]),

            'projection' => implode(
                ',',
                ProjectionBuilder::deviceDetail()
            ),

        ]);

        if (empty($data)) {
            return null;
        }

        return DeviceDTO::fromArray(
            $data[0]
        );
    }

    /**
     * Refresh Parameter
     */
    public function refresh(
        string $deviceId
    ): array {

        return $this->post(

            "/devices/{$deviceId}/tasks",

            [

                'name' => 'refreshObject',

                'objectName' => '',

            ]

        );
    }

    /**
     * Reboot Device
     */
    public function reboot(
        string $deviceId
    ): array {

        return $this->post(

            "/devices/{$deviceId}/tasks",

            [

                'name' => 'reboot',

            ]

        );

    }

}