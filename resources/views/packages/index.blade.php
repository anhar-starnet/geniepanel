@extends('adminlte::page')

@section('title', 'Paket Internet')

@section('plugins.Datatables', true)

@section('content_header')
<h1>Paket Internet</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">

        <a href="{{ route('packages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tambah Paket
        </a>

    </div>

    <div class="card-body">

        <table id="packagesTable" class="table table-bordered table-striped">

            <thead>

            <tr>
                <th>Kode</th>
                <th>Nama Paket</th>
                <th>Download</th>
                <th>Upload</th>
                <th>Harga</th>
                <th>Status</th>
                <th width="140">Aksi</th>
            </tr>

            </thead>

            <tbody>

            @forelse($packages as $package)

                <tr>

                    <td>{{ $package->code }}</td>

                    <td>{{ $package->name }}</td>

                    <td>{{ number_format($package->download_kbps / 1000,0) }} Mbps</td>

                    <td>{{ number_format($package->upload_kbps / 1000,0) }} Mbps</td>

                    <td>Rp {{ number_format($package->price,0,',','.') }}</td>

                    <td>

                        @if($package->status)

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

                        <a href="{{ route('packages.edit',$package) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>

                        <form
                            action="{{ route('packages.destroy',$package) }}"
                            method="POST"
                            style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus paket ini?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        Belum ada paket.

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

$(function () {

    $('#packagesTable').DataTable({

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