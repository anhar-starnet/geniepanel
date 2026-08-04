@extends('adminlte::page')

@section('title', 'Customer 360')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <div>

        <h1 class="mb-0">

            <i class="fas fa-user-circle text-primary"></i>

            Customer 360

        </h1>

        <small class="text-muted">

            Detail lengkap pelanggan

        </small>

    </div>

    <div>

        <a href="{{ route('customers.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <a href="{{ route('customers.edit', $customer) }}"
           class="btn btn-warning">

            <i class="fas fa-edit"></i>

            Edit

        </a>

    </div>

</div>

@stop


@section('content')

<div class="row">

    {{-- ===========================
         CUSTOMER
    ============================ --}}

    <div class="col-lg-6">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-user"></i>

                    Informasi Customer

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>
                    <th width="180">Kode Customer</th>
                    <td>{{ $customer->customer_code }}</td>
                </tr>

                <tr>
                    <th>Nama</th>
                    <td>{{ $customer->name }}</td>
                </tr>

                <tr>
                    <th>NIK</th>
                    <td>{{ $customer->nik ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Telepon</th>
                    <td>{{ $customer->phone ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $customer->email ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>{{ $customer->address ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Status</th>

                    <td>

                        <span class="badge badge-{{ $customer->badgeClass() }}">

                            {{ $customer->statusText() }}

                        </span>

                    </td>

                </tr>

            </table>

        </div>

    </div>


    {{-- ===========================
         INTERNET SERVICE
    ============================ --}}

    <div class="col-lg-6">

        <div class="card card-success">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-globe"></i>

                    Internet Service

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>

                    <th width="180">

                        Jenis Layanan

                    </th>

                    <td>

                        {{ $customer->serviceTypeText() }}

                    </td>

                </tr>

                <tr>

                    <th>Paket</th>

                    <td>

                        {{ $customer->package?->name ?? '-' }}

                    </td>

                </tr>

                <tr>

                    <th>Download</th>

                    <td>

                        @if($customer->package)

                            {{ number_format($customer->package->download_kbps / 1000, 0) }} Mbps

                        @else

                            -

                        @endif

                    </td>

                </tr>

                <tr>

                    <th>Upload</th>

                    <td>

                        @if($customer->package)

                            {{ number_format($customer->package->upload_kbps / 1000, 0) }} Mbps

                        @else

                            -

                        @endif

                    </td>

                </tr>

                <tr>

                    <th>Harga</th>

                    <td>

                        @if($customer->package)

                            Rp {{ number_format($customer->package->price,0,',','.') }}

                        @else

                            -

                        @endif

                    </td>

                </tr>

            </table>

        </div>

    </div>

</div>
<div class="row">

    {{-- ===========================
         ONT
    ============================ --}}

    <div class="col-lg-6">

        <div class="card card-info">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-broadcast-tower"></i>

                    Informasi ONT

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>
                    <th width="180">Kode ONT</th>
                    <td>{{ $customer->ont?->code ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Vendor</th>
                    <td>{{ $customer->ont?->vendor ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Model</th>
                    <td>{{ $customer->ont?->model ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Serial Number</th>
                    <td>{{ $customer->ont?->serial_number ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Firmware</th>
                    <td>{{ $customer->ont?->firmware ?? '-' }}</td>
                </tr>

            </table>

        </div>

    </div>


    {{-- ===========================
         FIBER PATH
    ============================ --}}

    <div class="col-lg-6">

        <div class="card card-secondary">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-project-diagram"></i>

                    Fiber Path

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>
                    <th width="180">Area</th>
                    <td>{{ $customer->area()?->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>POP</th>
                    <td>
                        {{ $customer->ont?->splitterPort?->splitter?->odp?->pop?->name ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>ODP</th>
                    <td>
                        {{ $customer->ont?->splitterPort?->splitter?->odp?->name ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Splitter</th>
                    <td>
                        {{ $customer->ont?->splitterPort?->splitter?->name ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Port Splitter</th>
                    <td>
                        {{ $customer->ont?->splitterPort?->port_number ?? '-' }}
                    </td>
                </tr>

            </table>

        </div>

    </div>

</div>
<div class="row">

    {{-- ===========================
         AUTHENTICATION
    ============================ --}}

    <div class="col-lg-6">

        <div class="card card-warning">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-key"></i>

                    Authentication

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>

                    <th width="180">Jenis</th>

                    <td>{{ $customer->serviceTypeText() }}</td>

                </tr>

                <tr>

                    <th>Username</th>

                    <td>{{ $customer->pppoe_username ?: '-' }}</td>

                </tr>

                <tr>

                    <th>Password</th>

                    <td>{{ $customer->pppoe_password ?: '-' }}</td>

                </tr>

            </table>

        </div>

    </div>

    {{-- ===========================
     GENIEACS LIVE
=========================== --}}

<div class="col-lg-6">

    <div class="card card-dark">

        <div class="card-header">

            <h3 class="card-title">

                <i class="fas fa-chart-line"></i>

                GenieACS Live

            </h3>

        </div>

        <table class="table table-bordered mb-0">

            @php
                $device = $customer360['device'] ?? null;
            @endphp

            <tr>

                <th width="180">Status ONU</th>

                <td>

                    @if($device)

                        @if($device->isOnline())

                            <span class="badge badge-success">

                                Online

                            </span>

                        @else

                            <span class="badge badge-danger">

                                Offline

                            </span>

                        @endif

                    @else

                        <span class="badge badge-secondary">

                            Tidak ditemukan

                        </span>

                    @endif

                </td>

            </tr>

            <tr>

                <th>Vendor</th>

                <td>{{ $device?->manufacturer ?? '-' }}</td>

            </tr>

            <tr>

                <th>Model</th>

                <td>{{ $device?->productClass ?? '-' }}</td>

            </tr>

            <tr>

                <th>Serial Number</th>

                <td>{{ $device?->serialNumber ?? '-' }}</td>

            </tr>

            <tr>

                <th>Firmware</th>

                <td>{{ $device?->firmware ?? '-' }}</td>

            </tr>

            <tr>

                <th>Last Inform</th>

                <td>{{ $device?->lastInform ?? '-' }}</td>

            </tr>

            <tr>

                <th>RX Power</th>

                <td>{{ $device?->rxPower ?? '-' }}</td>

            </tr>

            <tr>

                <th>Temperature</th>

                <td>

                    @if($device?->temperature)

                        {{ $device->temperature }} °C

                    @else

                        -

                    @endif

                </td>

            </tr>

            <tr>

                <th>Uptime</th>

                <td>{{ $device?->uptime ?? '-' }}</td>

            </tr>

            <tr>

                <th>PPPoE Username</th>

                <td>{{ $device?->pppoeUsername ?? '-' }}</td>

            </tr>

            <tr>

                <th>PPPoE IP</th>

                <td>{{ $device?->pppoeIP ?? '-' }}</td>

            </tr>

        </table>

    </div>

</div>

    <div class="card-body">

        <div class="btn-group">

    <a href="{{ route('customers.activate', $customer) }}"
       class="btn btn-success">

        <i class="fas fa-play-circle"></i>

        Aktivasi

    </a>

    <a href="{{ route('customers.edit', $customer) }}"
       class="btn btn-warning">

        <i class="fas fa-edit"></i>

        Edit

    </a>
    @if($customer->ont)

    <a href="{{ route('onts.show', $customer->ont) }}"
       class="btn btn-info">

        <i class="fas fa-broadcast-tower"></i>

        Detail ONT

    </a>

    <a href="{{ route('customers.assign-ont', $customer) }}"
       class="btn btn-warning">

        <i class="fas fa-exchange-alt"></i>

        Ganti ONT

    </a>

@else

    <a href="{{ route('customers.assign-ont', $customer) }}"
       class="btn btn-primary">

        <i class="fas fa-link"></i>

        Assign ONT

    </a>

@endif

    {{-- Suspend --}}
    @if($customer->status === 'active')

    <form action="{{ route('customers.suspend', $customer) }}"
          method="POST"
          class="d-inline"
          onsubmit="return confirm('Suspend customer ini?')">

        @csrf

        <button class="btn btn-secondary">

            <i class="fas fa-pause-circle"></i>

            Suspend

        </button>

    </form>

    @endif

    {{-- Resume --}}
    @if($customer->status === 'suspend')

    <form action="{{ route('customers.resume', $customer) }}"
          method="POST"
          class="d-inline"
          onsubmit="return confirm('Aktifkan kembali customer ini?')">

        @csrf

        <button class="btn btn-success">

            <i class="fas fa-play"></i>

            Resume

        </button>

    </form>

    @endif

    {{-- Terminasi --}}
    @if($customer->status !== 'terminated')

    <form action="{{ route('customers.terminate', $customer) }}"
          method="POST"
          class="d-inline"
          onsubmit="return confirm('Yakin terminasi customer ini?')">

        @csrf

        @method('DELETE')

        <button class="btn btn-danger">

            <i class="fas fa-times-circle"></i>

            Terminasi

        </button>

    </form>

    @endif

</div>

    </div>

</div>

@stop