@extends('adminlte::page')

@section('title', 'Detail Port Splitter')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Detail Port Splitter</h1>

    <a href="{{ route('splitters.show', $splitterPort->splitter) }}"
       class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>
</div>
@stop

@section('content')

<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">

            {{ $splitterPort->splitter->code }}
            -
            Port {{ $splitterPort->port_number }}

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-borderless">

            <tr>
                <th width="25%">Status</th>
                <td>
                    <span class="badge badge-{{ $splitterPort->badgeClass() }}">
                        {{ $splitterPort->statusText() }}
                    </span>
                </td>
            </tr>

            <tr>
                <th>Splitter</th>
                <td>{{ $splitterPort->splitter->name }}</td>
            </tr>

            <tr>
                <th>ODP</th>
                <td>{{ $splitterPort->splitter->odp->name }}</td>
            </tr>

            <tr>
                <th>POP</th>
                <td>{{ $splitterPort->splitter->odp->pop->name }}</td>
            </tr>

            <tr>
                <th>Area</th>
                <td>{{ $splitterPort->splitter->odp->pop->area->name }}</td>
            </tr>

        </table>

    </div>

</div>

@if($splitterPort->isFree())

<div class="alert alert-success">

    <h5>
        <i class="fas fa-check-circle"></i>
        Port Kosong
    </h5>

    Port ini masih tersedia dan siap digunakan
    untuk pemasangan ONT baru.

</div>

@endif

@if($splitterPort->isUsed())

<div class="alert alert-primary">

    <h5>
        <i class="fas fa-network-wired"></i>
        Port Terpakai
    </h5>

    Detail ONT akan ditampilkan pada Sprint 4.

</div>

@endif

@if($splitterPort->isReserved())

<div class="alert alert-warning">

    <h5>
        <i class="fas fa-bookmark"></i>
        Port Dicadangkan
    </h5>

</div>

@endif

@if($splitterPort->isBroken())

<div class="alert alert-danger">

    <h5>
        <i class="fas fa-tools"></i>
        Port Rusak
    </h5>

</div>

@endif

@stop