@extends('adminlte::page')

@section('title', 'Data Pelanggan')

@section('content_header')
    <h1>Data Pelanggan</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <a href="{{ route('customers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pelanggan
        </a>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($customers as $customer)

                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->customer_code }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->status }}</td>

                    <td width="220">

                        <a href="{{ route('customers.edit',$customer->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form
                            action="{{ route('customers.destroy',$customer->id) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">

                                Hapus

                            </button>

                        </form>

                      </td>
                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center">
                        Belum ada data pelanggan
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
