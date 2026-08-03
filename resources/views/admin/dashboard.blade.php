@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-tachometer-alt"></i>
        Dashboard GeniePanel
    </h1>

    <small class="text-muted">
        {{ now()->format('d F Y H:i') }}
    </small>
</div>
@stop

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $customerTotal }}</h3>
                <p>Total Customer</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('customers.index') }}"
               class="small-box-footer">
                Lihat Data
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $ontTotal }}</h3>
                <p>Total ONT</p>
            </div>
            <div class="icon">
                <i class="fas fa-network-wired"></i>
            </div>
            <a href="{{ route('onts.index') }}"
               class="small-box-footer">
                Lihat Data
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $packageTotal }}</h3>
                <p>Paket Internet</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="{{ route('packages.index') }}"
               class="small-box-footer">
                Lihat Data
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $splitterTotal }}</h3>
                <p>Splitter</p>
            </div>
            <div class="icon">
                <i class="fas fa-code-branch"></i>
            </div>
            <a href="{{ route('splitters.index') }}"
               class="small-box-footer">
                Lihat Data
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="card">

            <div class="card-header bg-success">

                <h3 class="card-title">

                    Status Customer

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>
                    <th>Aktif</th>
                    <td>{{ $customerActive }}</td>
                </tr>

                <tr>
                    <th>Suspend</th>
                    <td>{{ $customerSuspend }}</td>
                </tr>

                <tr>
                    <th>Terminasi</th>
                    <td>{{ $customerTerminate }}</td>
                </tr>

            </table>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card">

            <div class="card-header bg-primary">

                <h3 class="card-title">

                    Infrastruktur

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>
                    <th>Area</th>
                    <td>{{ $areaTotal }}</td>
                </tr>

                <tr>
                    <th>POP</th>
                    <td>{{ $popTotal }}</td>
                </tr>

                <tr>
                    <th>ODP</th>
                    <td>{{ $odpTotal }}</td>
                </tr>

                <tr>
                    <th>Splitter</th>
                    <td>{{ $splitterTotal }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@stop