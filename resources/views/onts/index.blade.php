@extends('adminlte::page')

@section('title', 'Inventory ONT')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Inventory ONT</h1>

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

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>Kode</th>

                    <th>Perangkat</th>

                    <th>Serial Number</th>

                    <th>Lokasi</th>

                    <th>Status</th>

                    <th width="150">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($onts as $ont)

                <tr>

                    <td>{{ $ont->code }}</td>

                    <td>{{ $ont->displayName() }}</td>

                    <td>{{ $ont->serial_number }}</td>

                    <td>

                        <td>

    <a href="{{ route('onts.show', $ont) }}"
       class="btn btn-info btn-sm">
        Detail
    </a>

    @if($ont->splitter_port_id)

        <form action="{{ route('onts.release', $ont) }}"
              method="POST"
              style="display:inline;">

            @csrf

            <button
                class="btn btn-danger btn-sm"
                onclick="return confirm('Lepaskan ONT dari port?')">

                Lepaskan

            </button>

        </form>

    @else

        <a href="{{ route('onts.deploy', $ont) }}"
           class="btn btn-success btn-sm">

            Deploy

        </a>

    @endif

    <a href="{{ route('onts.edit', $ont) }}"
       class="btn btn-warning btn-sm">

        Ubah

    </a>

</td>

                    </td>

                    <td>

                        @if($ont->status)

                            <span class="badge badge-success">

                                Aktif

                            </span>

                        @else

                            <span class="badge badge-danger">

                                Nonaktif

                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('onts.show', $ont) }}"
                           class="btn btn-info btn-sm">

                            Detail

                        </a>

                        <a href="{{ route('onts.edit', $ont) }}"
                           class="btn btn-warning btn-sm">

                            Ubah

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        Belum ada data ONT.

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