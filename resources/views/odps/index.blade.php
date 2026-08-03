@extends('adminlte::page')

@section('title', 'Data ODP')

@section('plugins.Datatables', true)

@section('content_header')
<h1>Data ODP</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">

        <a href="{{ route('odps.create') }}" class="btn btn-primary">

            <i class="fas fa-plus"></i>

            Tambah ODP

        </a>

    </div>

    <div class="card-body">

        <table id="odpTable" class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>Kode</th>

                    <th>POP</th>

                    <th>Nama ODP</th>

                    <th>Tipe</th>

                    <th>Port</th>

                    <th>Terpakai</th>

                    <th>Status</th>

                    <th width="150">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($odps as $odp)

                <tr>

                    <td>{{ $odp->code }}</td>

                    <td>{{ $odp->pop->name }}</td>

                    <td>{{ $odp->name }}</td>

                    <td>{{ $odp->distribution_type }}</td>

                    <td>{{ $odp->port_capacity }}</td>

                    <td>{{ $odp->used_ports }}</td>

                    <td>

                        @if($odp->status)

                            <span class="badge badge-success">
                                Aktif
                            </span>

                        @else

                            <span class="badge badge-danger">
                                Non Aktif
                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('odps.edit', $odp) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>

                        <form action="{{ route('odps.destroy', $odp) }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus ODP ini?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center">

                        Belum ada data ODP.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop

@push('js')

<script>

$(function(){

    $('#odpTable').DataTable({

        responsive: true,

        autoWidth: false,

        pageLength: 10,

        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
        }

    });

});

</script>

@endpush