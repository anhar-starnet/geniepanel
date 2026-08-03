@extends('adminlte::page')

@section('title', 'Deploy ONT')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Deploy ONT</h1>

    <a href="{{ route('onts.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>

</div>

@stop

@section('content')

<div class="row">

    <div class="col-md-4">

        <div class="card card-info">

            <div class="card-header">

                <h3 class="card-title">

                    Informasi ONT

                </h3>

            </div>

            <div class="card-body">

                <table class="table table-sm">

                    <tr>
                        <th>Kode</th>
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
                        <th>Serial Number</th>
                        <td>{{ $ont->serial_number }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-8">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    Pilih Port Kosong

                </h3>

            </div>

            <form method="POST"
                  action="{{ route('onts.deploy.store', $ont) }}">

                @csrf

                <div class="card-body">

                    <div class="form-group">

                        <label>Port Tujuan</label>

                        <select
                            name="splitter_port_id"
                            class="form-control"
                            required>

                            <option value="">
                                -- Pilih Port --
                            </option>

                            @foreach($ports as $port)

                                <option value="{{ $port->id }}">

                                    {{ $port->splitter->odp->pop->area->name }}
                                    /
                                    {{ $port->splitter->odp->pop->name }}
                                    /
                                    {{ $port->splitter->odp->name }}
                                    /
                                    {{ $port->splitter->code }}
                                    /
                                    Port {{ $port->port_number }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="card-footer">

                    <button
                        class="btn btn-success">

                        <i class="fas fa-plug"></i>

                        Deploy ONT

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@stop