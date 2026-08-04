<?php

namespace App\Services\GenieACS;

use App\Models\Customer;
use App\Models\Ont;
use Illuminate\Support\Facades\Log;

class OntSyncService
{
    public function __construct(
        protected DeviceRepository $repository
    ) {
    }

    /**
     * Sinkronkan satu ONT berdasarkan Serial Number.
     */
    public function sync(Ont $ont): bool
    {
        if (blank($ont->serial_number)) {
            return false;
        }

        $device = $this->repository->findBySerial(
            $ont->serial_number
        );

        if (!$device) {
            Log::info(
                'GenieACS device tidak ditemukan.',
                [
                    'serial_number' => $ont->serial_number,
                ]
            );

            return false;
        }

        $updated = false;

        $data = [];

        if ($ont->genieacs_device_id !== $device->id) {
            $data['genieacs_device_id'] = $device->id;
            $updated = true;
        }

        if ($ont->vendor !== $device->manufacturer) {
            $data['vendor'] = $device->manufacturer;
            $updated = true;
        }

        if ($ont->model !== $device->productClass) {
            $data['model'] = $device->productClass;
            $updated = true;
        }

        if ($ont->firmware !== $device->firmware) {
            $data['firmware'] = $device->firmware;
            $updated = true;
        }

        if ($updated) {
            $ont->update($data);
        }

        return true;
    }

    /**
     * Sinkronkan ONT milik Customer.
     */
    public function syncCustomer(
        Customer $customer
    ): bool {

        if (!$customer->ont) {
            return false;
        }

        return $this->sync(
            $customer->ont
        );
    }

    /**
     * Sinkronkan seluruh ONT.
     */
    public function syncAll(): int
    {
        $count = 0;

        Ont::query()
            ->whereNotNull('serial_number')
            ->each(function (Ont $ont) use (&$count) {

                if ($this->sync($ont)) {
                    $count++;
                }

            });

        return $count;
    }
}