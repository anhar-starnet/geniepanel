@extends('adminlte::page')

@section('title', 'Detail ONT')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-network-wired mr-2"></i>
        Detail ONT
    </h1>

    <div>

        <a href="{{ route('onts.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>
            Kembali

        </a>

        <a href="{{ route('onts.edit', $ont) }}"
           class="btn btn-warning">

            <i class="fas fa-edit"></i>
            Edit

        </a>

    </div>

</div>

@stop

@section('content')

<div class="row">

    <div class="col-md-5">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    Informasi ONT

                </h3>

            </div>

            <table class="table table-striped mb-0">

                <tr>
                    <th width="35%">Kode</th>
                    <td>{{ $ont->code }}</td>
                </tr>

                <tr>
                    <th>Vendor</th>
                    <td>{{ $ont->vendor }}</td>
                </tr>

                <tr>
                    <th>Model</th>
                    <td>{{ $ont->model }}</td>
                </tr>

                <tr>
                    <th>Serial</th>
                    <td><code>{{ $ont->serial_number }}</code></td>
                </tr>

                <tr>
                    <th>Firmware</th>
                    <td>{{ $ont->firmware ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>

                        <span class="badge badge-{{ $ont->statusBadge() }}">
                            {{ $ont->statusText() }}
                        </span>

                    </td>

                </tr>

                <tr>
                    <th>Deploy</th>
                    <td>

                        <span class="badge badge-{{ $ont->deploymentBadge() }}">
                            {{ $ont->deploymentText() }}
                        </span>

                    </td>

                </tr>

            </table>

        </div>

    </div>

    <div class="col-md-7">

        <div class="card card-success">

            <div class="card-header">

                <h3 class="card-title">

                    Fiber Path

                </h3>

            </div>

            <table class="table table-striped mb-0">

                <tr>
                    <th width="35%">Area</th>
                    <td>{{ $ont->splitterPort?->splitter?->odp?->pop?->area?->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>POP</th>
                    <td>{{ $ont->splitterPort?->splitter?->odp?->pop?->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>ODP</th>
                    <td>{{ $ont->splitterPort?->splitter?->odp?->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Splitter</th>
                    <td>{{ $ont->splitterPort?->splitter?->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Port</th>
                    <td>{{ $ont->splitterPort?->port_number ?? '-' }}</td>
                </tr>

            </table>

        </div>

        <div class="card card-info">

            <div class="card-header">

                <h3 class="card-title">

                    Customer

                </h3>

            </div>

            <div class="card-body">

                @if($ont->customer)

                    <p>

                        <strong>{{ $ont->customer->name }}</strong>

                    </p>

                    <p>

                        {{ $ont->customer->customer_code }}

                    </p>

                    <a href="{{ route('customers.show', $ont->customer) }}"
                       class="btn btn-primary">

                        Lihat Customer

                    </a>

                @else

                    <div class="alert alert-warning mb-0">

                        Belum dipakai customer.

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@stop