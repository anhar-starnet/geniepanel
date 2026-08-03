@extends('adminlte::page')

@section('title', 'Data Splitter')

@section('plugins.Datatables', true)

@section('content_header')
<h1>Data Splitter</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">

        <a href="{{ route('splitters.create') }}" class="btn btn-primary">

            <i class="fas fa-plus"></i>

            Tambah Splitter

        </a>

    </div>

    <div class="card-body">

        <table id="splitterTable" class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>Kode</th>
                    <th>ODP</th>
                    <th>Nama</th>
                    <th>Ratio</th>
                    <th>Total Port</th>
                    <th>Terpakai</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($splitters as $splitter)

                <tr>

                    <td>{{ $splitter->code }}</td>

                    <td>{{ $splitter->odp->name }}</td>

                    <td>{{ $splitter->name }}</td>

                    <td>{{ $splitter->ratio }}</td>

                    <td>{{ $splitter->total_ports }}</td>

                    <td>{{ $splitter->used_ports }}</td>

                    <td>

                        @if($splitter->status)

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

                        <a href="{{ route('splitters.edit', $splitter) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>

                        <form action="{{ route('splitters.destroy', $splitter) }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus Splitter ini?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center">

                        Belum ada data Splitter.

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

    $('#splitterTable').DataTable({

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