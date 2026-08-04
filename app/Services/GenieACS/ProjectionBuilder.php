<?php

namespace App\Services\GenieACS;

class ProjectionBuilder
{
    /**
     * Projection untuk daftar device
     */
    public static function deviceList(): array
    {
        return [

            '_id',

            '_deviceId._Manufacturer',
            '_deviceId._ProductClass',
            '_deviceId._SerialNumber',

            '_lastInform',

            '_tags',

            'VirtualParameters.pppoeUsername',
            'VirtualParameters.pppoeIP',
            'VirtualParameters.RXPower',
            'VirtualParameters.gettemp',
            'VirtualParameters.getdeviceuptime',

        ];
    }

    /**
     * Projection untuk detail device
     */
    public static function deviceDetail(): array
    {
        return [

            ...self::deviceList(),

            '_lastBoot',

            '_registered',

            'InternetGatewayDevice.DeviceInfo.HardwareVersion',
            'InternetGatewayDevice.DeviceInfo.SoftwareVersion',

            'InternetGatewayDevice.LANDevice.1.LANEthernetInterfaceConfig.1.MACAddress',

            'InternetGatewayDevice.WANDevice',

            'InternetGatewayDevice.LANDevice.1.Hosts.Host',

        ];
    }
}