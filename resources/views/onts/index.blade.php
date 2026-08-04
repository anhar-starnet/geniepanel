@extends('adminlte::page')

@section('title', 'Inventory ONT')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-network-wired mr-2"></i>
        Inventory ONT
    </h1>

    <a href="{{ route('onts.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus"></i>

        Tambah ONT

    </a>

</div>

@stop

@section('content')

<div class="row">

    <div class="col-md-3">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>{{ $onts->total() }}</h3>

                <p>Total ONT</p>

            </div>

            <div class="icon">

                <i class="fas fa-network-wired"></i>

            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Daftar Inventory ONT

        </h3>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover table-striped">

            <thead>

            <tr>

                <th>Kode</th>

                <th>Perangkat</th>

                <th>Serial Number</th>

                <th>Fiber Path</th>

                <th>Deploy</th>

                <th>Status</th>

                <th>Customer</th>

                <th width="230">Aksi</th>

            </tr>

            </thead>

            <tbody>

            @forelse($onts as $ont)

                <tr>

                    <td>

                        <strong>{{ $ont->code }}</strong>

                    </td>

                    <td>

                        {{ $ont->displayName() }}

                    </td>

                    <td>

                        <code>

                            {{ $ont->serial_number ?: '-' }}

                        </code>

                    </td>

                    <td>

                        @if($ont->splitterPort)

                            <small>

                                {{ $ont->splitterPort->splitter?->odp?->pop?->area?->name ?? '-' }}

                                <br>

                                {{ $ont->splitterPort->splitter?->odp?->pop?->name ?? '-' }}

                                <br>

                                {{ $ont->splitterPort->splitter?->odp?->name ?? '-' }}

                                <br>

                                {{ $ont->splitterPort->splitter?->name ?? '-' }}

                                /

                                Port {{ $ont->splitterPort->port_number }}

                            </small>

                        @else

                            <span class="text-muted">

                                Belum Deploy

                            </span>

                        @endif

                    </td>

                    <td>

                        <span class="badge badge-{{ $ont->deploymentBadge() }}">

                            {{ $ont->deploymentText() }}

                        </span>

                    </td>

                    <td>

                        <span class="badge badge-{{ $ont->statusBadge() }}">

                            {{ $ont->statusText() }}

                        </span>

                    </td>

                    <td>

                        @if($ont->customer)

                            <a href="{{ route('customers.show',$ont->customer) }}">

                                {{ $ont->customer->name }}

                            </a>

                        @else

                            <span class="text-muted">

                                -

                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('onts.show',$ont) }}"
                           class="btn btn-info btn-sm">

                            <i class="fas fa-eye"></i>

                        </a>

                        <a href="{{ route('onts.edit',$ont) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>

                        @if($ont->isDeployed())

                            <form
                                action="{{ route('onts.release',$ont) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Lepaskan ONT dari Splitter?')">

                                    <i class="fas fa-unlink"></i>

                                </button>

                            </form>

                        @else

                            <a href="{{ route('onts.deploy',$ont) }}"
                               class="btn btn-success btn-sm">

                                <i class="fas fa-link"></i>

                            </a>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center text-muted">

                        Belum ada Inventory ONT.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $onts->links() }}

    </div>

</div>

@stop