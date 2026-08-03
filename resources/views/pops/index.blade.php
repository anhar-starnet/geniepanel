@extends('adminlte::page')

@section('title', 'Data POP')

@section('plugins.Datatables', true)

@section('content_header')
<h1>Data POP</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">

        <a href="{{ route('pops.create') }}"
           class="btn btn-primary">

            <i class="fas fa-plus"></i>

            Tambah POP

        </a>

    </div>

    <div class="card-body">

        <table id="popTable"
               class="table table-bordered table-striped">

            <thead>

            <tr>

                <th>Kode</th>
                <th>Area</th>
                <th>Nama POP</th>
                <th>Alamat</th>
                <th>Status</th>
                <th width="150">Aksi</th>

            </tr>

            </thead>

            <tbody>

            @forelse($pops as $pop)

                <tr>

                    <td>{{ $pop->code }}</td>

                    <td>{{ $pop->area->name }}</td>

                    <td>{{ $pop->name }}</td>

                    <td>{{ $pop->address }}</td>

                    <td>

                        @if($pop->status)

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

                        <a href="{{ route('pops.edit',$pop) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>

                        <form action="{{ route('pops.destroy',$pop) }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus POP ini?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        Belum ada data POP.

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

    $('#popTable').DataTable({

        responsive:true,

        autoWidth:false,

        pageLength:10,

        language:{

            url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'

        }

    });

});

</script>

@endpush