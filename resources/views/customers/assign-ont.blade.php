@extends('adminlte::page')

@section('title', 'Assign ONT')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>

        <i class="fas fa-network-wired mr-2"></i>

        Assign ONT

    </h1>

    <a href="{{ route('customers.show', $customer) }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Kembali

    </a>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Customer :
            <strong>{{ $customer->name }}</strong>

        </h3>

    </div>

    <div class="card-body">

        @if($onts->isEmpty())

            <div class="alert alert-warning mb-0">

                Tidak ada ONT yang tersedia.

            </div>

        @else

            <div class="row">

                @foreach($onts as $ont)

                    <div class="col-lg-6">

                        <div class="card card-outline card-primary">

                            <div class="card-header">

                                <h3 class="card-title">

                                    {{ $ont->code }}

                                </h3>

                            </div>

                            <div class="card-body">

                                <table class="table table-sm table-borderless">

                                    <tr>
                                        <th width="35%">Vendor</th>
                                        <td>{{ $ont->vendor }}</td>
                                    </tr>

                                    <tr>
                                        <th>Model</th>
                                        <td>{{ $ont->model }}</td>
                                    </tr>

                                    <tr>
                                        <th>Serial</th>
                                        <td>
                                            <code>{{ $ont->serial_number }}</code>
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

                                    <tr>
                                        <th>Area</th>
                                        <td>

                                            {{ $ont->splitterPort?->splitter?->odp?->pop?->area?->name ?? '-' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <th>POP</th>
                                        <td>

                                            {{ $ont->splitterPort?->splitter?->odp?->pop?->name ?? '-' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <th>ODP</th>
                                        <td>

                                            {{ $ont->splitterPort?->splitter?->odp?->name ?? '-' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Splitter</th>
                                        <td>

                                            {{ $ont->splitterPort?->splitter?->name ?? '-' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Port</th>
                                        <td>

                                            {{ $ont->splitterPort?->port_number ?? '-' }}

                                        </td>
                                    </tr>

                                </table>

                            </div>

                            <div class="card-footer text-right">

                                <form method="POST"
                                      action="{{ route('customers.assign-ont.store', $customer) }}">

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="ont_id"
                                        value="{{ $ont->id }}">

                                    <button
                                        class="btn btn-success">

                                        <i class="fas fa-check"></i>

                                        Gunakan ONT

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</div>

@stop