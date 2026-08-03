@extends('adminlte::page')

@section('title','Master Area')

@section('plugins.Datatables', true)

@section('content_header')
<h1>Master Area</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">

        <a href="{{ route('areas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tambah Area
        </a>

    </div>

    <div class="card-body">

        <table id="areaTable" class="table table-bordered table-striped">

            <thead>

            <tr>
                <th>Kode</th>
                <th>Nama Area</th>
                <th>PIC</th>
                <th>HP</th>
                <th>Status</th>
                <th width="150">Aksi</th>
            </tr>

            </thead>

            <tbody>

            @foreach($areas as $area)

            <tr>

                <td>{{ $area->code }}</td>

                <td>{{ $area->name }}</td>

                <td>{{ $area->pic }}</td>

                <td>{{ $area->phone }}</td>

                <td>
                    @if($area->status)
                        <span class="badge badge-success">Aktif</span>
                    @else
                        <span class="badge badge-danger">Non Aktif</span>
                    @endif
                </td>

                <td>

                    <a href="{{ route('areas.edit',$area) }}"
                       class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('areas.destroy',$area) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus area ini?')">

                            <i class="fas fa-trash"></i>

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop

@push('js')
<script>
$(function () {
    $('#areaTable').DataTable({
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