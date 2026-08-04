<?php

namespace App\Services\GenieACS;

use Carbon\Carbon;

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

    /*
    |--------------------------------------------------------------------------
    | ONLINE
    |--------------------------------------------------------------------------
    */

    public function isOnline(): bool
    {
        if (!$this->lastInform) {
            return false;
        }

        return Carbon::parse($this->lastInform)
            ->diffInMinutes(now()) <= 10;
    }

    public function onlineLabel(): string
    {
        return $this->isOnline()
            ? 'Online'
            : 'Offline';
    }

    public function onlineBadgeClass(): string
    {
        return $this->isOnline()
            ? 'success'
            : 'danger';
    }

    /*
    |--------------------------------------------------------------------------
    | RX POWER
    |--------------------------------------------------------------------------
    */

    public function rxValue(): float
    {
        return (float) $this->rxPower;
    }

    public function rxStatus(): string
    {
        $rx = $this->rxValue();

        return match (true) {

            $rx >= -20 => 'Excellent',

            $rx >= -25 => 'Normal',

            $rx >= -27 => 'Fair',

            $rx >= -30 => 'Warning',

            default => 'Critical',

        };
    }

    public function rxBadgeClass(): string
    {
        return match ($this->rxStatus()) {

            'Excellent' => 'primary',

            'Normal' => 'success',

            'Fair' => 'warning',

            'Warning' => 'orange',

            default => 'danger',

        };
    }

    public function rxLabel(): string
    {
        return sprintf(
            '%s dBm (%s)',
            $this->rxPower,
            $this->rxStatus()
        );
    }

    public function rxPercentage(): int
    {
        $rx = max(-35, min(-15, $this->rxValue()));

        return (int) (($rx + 35) / 20 * 100);
    }

    /*
    |--------------------------------------------------------------------------
    | TEMPERATURE
    |--------------------------------------------------------------------------
    */

    public function temperatureValue(): float
    {
        return (float) $this->temperature;
    }

    public function temperatureStatus(): string
    {
        $t = $this->temperatureValue();

        return match (true) {

            $t < 60 => 'Normal',

            $t < 70 => 'Warm',

            $t < 80 => 'Hot',

            default => 'Critical',

        };
    }

    public function temperatureBadgeClass(): string
    {
        return match ($this->temperatureStatus()) {

            'Normal' => 'success',

            'Warm' => 'warning',

            'Hot' => 'orange',

            default => 'danger',

        };
    }

    /*
    |--------------------------------------------------------------------------
    | LAST INFORM
    |--------------------------------------------------------------------------
    */

    public function lastInformHuman(): string
    {
        if (!$this->lastInform) {
            return '-';
        }

        return Carbon::parse(
            $this->lastInform
        )->diffForHumans();
    }

    public function lastInformBadgeClass(): string
    {
        if (!$this->lastInform) {
            return 'danger';
        }

        $minutes = Carbon::parse(
            $this->lastInform
        )->diffInMinutes(now());

        return match (true) {

            $minutes <= 5 => 'success',

            $minutes <= 30 => 'warning',

            $minutes <= 60 => 'orange',

            default => 'danger',

        };
    }

    /*
    |--------------------------------------------------------------------------
    | HEALTH SCORE
    |--------------------------------------------------------------------------
    */

    public function healthScore(): int
    {
        $score = 100;

        if (!$this->isOnline()) {
            $score -= 30;
        }

        if ($this->rxValue() < -30) {
            $score -= 30;
        } elseif ($this->rxValue() < -27) {
            $score -= 15;
        }

        if ($this->temperatureValue() >= 80) {
            $score -= 20;
        } elseif ($this->temperatureValue() >= 70) {
            $score -= 10;
        }

        return max(0, $score);
    }

    public function healthStatus(): string
    {
        $score = $this->healthScore();

        return match (true) {

            $score >= 95 => 'Excellent',

            $score >= 80 => 'Healthy',

            $score >= 60 => 'Fair',

            $score >= 40 => 'Warning',

            default => 'Critical',

        };
    }

    public function healthBadgeClass(): string
    {
        return match ($this->healthStatus()) {

            'Excellent' => 'primary',

            'Healthy' => 'success',

            'Fair' => 'warning',

            'Warning' => 'orange',

            default => 'danger',

        };
    }
}