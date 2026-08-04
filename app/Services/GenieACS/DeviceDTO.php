<?php

namespace App\Services\GenieACS;

class DeviceDTO
{
    public function __construct(
        public ?string $id,
        public ?string $manufacturer,
        public ?string $productClass,
        public ?string $serialNumber,
        public ?string $firmware,
        public ?string $hardware,
        public ?string $pppoeUsername,
        public ?string $pppoeIP,
        public ?string $rxPower,
        public ?string $temperature,
        public ?string $uptime,
        public ?string $lastInform,
        public array $tags = [],
        public array $raw = [],
    ) {
    }

    public static function fromArray(array $device): self
    {
        return new self(

            id: data_get($device, '_id'),

            manufacturer: data_get(
                $device,
                '_deviceId._Manufacturer'
            ),

            productClass: data_get(
                $device,
                '_deviceId._ProductClass'
            ),

            serialNumber: data_get(
                $device,
                '_deviceId._SerialNumber'
            ),

            firmware: data_get(
                $device,
                'InternetGatewayDevice.DeviceInfo.SoftwareVersion._value'
            ),

            hardware: data_get(
                $device,
                'InternetGatewayDevice.DeviceInfo.HardwareVersion._value'
            ),

            pppoeUsername: data_get(
                $device,
                'VirtualParameters.pppoeUsername._value'
            ),

            pppoeIP: data_get(
                $device,
                'VirtualParameters.pppoeIP._value'
            ),

            rxPower: data_get(
                $device,
                'VirtualParameters.RXPower._value'
            ),

            temperature: data_get(
                $device,
                'VirtualParameters.gettemp._value'
            ),

            uptime: data_get(
                $device,
                'VirtualParameters.getdeviceuptime._value'
            ),

            lastInform: data_get(
                $device,
                '_lastInform'
            ),

            tags: data_get(
                $device,
                '_tags',
                []
            ),

            raw: $device,
        );
    }

    public function isOnline(): bool
    {
        if (!$this->lastInform) {
            return false;
        }

        return now()
            ->diffInMinutes($this->lastInform)
            <= 10;
    }
}