@extends('adminlte::page')

@section('title', 'GenieACS Devices')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>GenieACS Devices</h1>

    <div>

        <a href="{{ route('genieacs.devices.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-list"></i>

            Semua

        </a>

        <a href="{{ route('genieacs.devices.index', ['filter' => 'assigned']) }}"
           class="btn btn-success">

            <i class="fas fa-link"></i>

            Assigned

        </a>

        <a href="{{ route('genieacs.devices.index', ['filter' => 'unassigned']) }}"
           class="btn btn-warning">

            <i class="fas fa-unlink"></i>

            Unassigned

        </a>

    </div>

</div>

@stop

@section('content')

<div class="row mb-3">

    <div class="col-md-2">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>{{ $statistics['total'] }}</h3>

                <p>Total Device</p>

            </div>

        </div>

    </div>

    <div class="col-md-2">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>{{ $statistics['online'] }}</h3>

                <p>Online</p>

            </div>

        </div>

    </div>

    <div class="col-md-2">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>{{ $statistics['offline'] }}</h3>

                <p>Offline</p>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-primary">

            <div class="inner">

                <h3>{{ $statistics['assigned'] }}</h3>

                <p>Assigned</p>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>{{ $statistics['unassigned'] }}</h3>

                <p>Unassigned</p>

            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-body p-0">

        <table class="table table-hover table-bordered mb-0">

            <thead>

            <tr>

                <th width="180">Serial Number</th>

                <th>Customer</th>

                <th width="170">PPPoE</th>

                <th width="150">Model</th>

                <th width="100">RX</th>

                <th width="90">Online</th>

                <th width="120">Status</th>

                <th width="120">Aksi</th>

            </tr>

            </thead>

            <tbody>

            @forelse($devices as $row)

                @php

                    $device = isset($row->device) ? $row->device : $row;
                    $customer = $row->customer ?? null;
                    $assigned = $row->assigned ?? false;

                @endphp

                <tr>

                    <td>

                        <strong>

                            {{ $device->serialNumber }}

                        </strong>

                    </td>

                    <td>

                        {{ $customer?->name ?? '-' }}

                    </td>

                    <td>

                        {{ $device->pppoeUsername ?: '-' }}

                    </td>

                    <td>

                        {{ $device->productClass }}

                    </td>

                    <td>

                        {{ $device->rxPower }}

                    </td>

                    <td>

                        @if($device->isOnline())

                            <span class="badge badge-success">

                                Online

                            </span>

                        @else

                            <span class="badge badge-danger">

                                Offline

                            </span>

                        @endif

                    </td>

                    <td>

                        @if($assigned)

                            <span class="badge badge-primary">

                                Assigned

                            </span>

                        @else

                            <span class="badge badge-warning">

                                Unassigned

                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('genieacs.devices.show', $device->serialNumber) }}"
                           class="btn btn-info btn-sm">

                            <i class="fas fa-eye"></i>

                            Detail

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8"
                        class="text-center">

                        Tidak ada device.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
