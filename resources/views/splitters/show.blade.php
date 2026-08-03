@extends('adminlte::page')

@section('title', 'Detail Splitter')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Detail Splitter</h1>

    <div>
        <a href="{{ route('splitters.edit', $splitter) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>

        <a href="{{ route('splitters.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@stop

@section('content')

<div class="row">

    {{-- Informasi Splitter --}}
    <div class="col-lg-4">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">{{ $splitter->code }}</h3>
            </div>

            <div class="card-body">

                <table class="table table-borderless">

                    <tr>
                        <th width="35%">Nama</th>
                        <td>{{ $splitter->name }}</td>
                    </tr>

                    <tr>
                        <th>Area</th>
                        <td>{{ $splitter->odp->pop->area->name }}</td>
                    </tr>

                    <tr>
                        <th>POP</th>
                        <td>{{ $splitter->odp->pop->name }}</td>
                    </tr>

                    <tr>
                        <th>ODP</th>
                        <td>{{ $splitter->odp->name }}</td>
                    </tr>

                    <tr>
                        <th>Rasio</th>
                        <td>{{ $splitter->ratio }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if($splitter->status)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Kapasitas Splitter</h3>
            </div>

            <div class="card-body">

                <div class="row text-center">

                    <div class="col">
                        <h4>{{ $splitter->total_ports }}</h4>
                        <small>Total</small>
                    </div>

                    <div class="col">
                        <h4>{{ $splitter->usedPortsCount() }}</h4>
                        <small>Terpakai</small>
                    </div>

                    <div class="col">
                        <h4>{{ $splitter->freePortsCount() }}</h4>
                        <small>Kosong</small>
                    </div>

                    <div class="col">
                        <h4>{{ $splitter->reservedPortsCount() }}</h4>
                        <small>Cadangan</small>
                    </div>

                    <div class="col">
                        <h4>{{ $splitter->brokenPortsCount() }}</h4>
                        <small>Rusak</small>
                    </div>

                </div>

                <br>

                <div class="progress">

                    <div
                        class="progress-bar bg-{{ $splitter->utilizationColor() }}"
                        style="width: {{ $splitter->utilizationPercent() }}%">

                        {{ $splitter->utilizationPercent() }}%

                    </div>

                </div>

            </div>

        </div>

        {{-- Grid Port --}}
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Port Splitter</h3>
            </div>

            <div class="card-body">

                <div class="row">

                    @foreach($splitter->ports as $port)

                        <div class="col-lg-3 col-md-4 col-6 mb-3">

                            <a href="{{ route('splitter-ports.show', $port) }}"
   class="text-decoration-none text-dark">

    <div class="card border shadow-sm h-100">

        <div class="card-body text-center">

            <h5 class="mb-3">
                Port {{ $port->port_number }}
            </h5>

            <span class="badge badge-{{ $port->badgeClass() }}">
                {{ $port->statusText() }}
            </span>

        </div>

    </div>

</a>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>

@stop