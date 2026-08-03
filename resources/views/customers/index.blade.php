@extends('adminlte::page')

@section('title', 'Data Pelanggan')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Data Pelanggan</h1>

    <a href="{{ route('customers.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus"></i>

        Tambah Pelanggan

    </a>

</div>

@stop

@section('content')

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card">

    <div class="card-body p-0">

        <table class="table table-hover table-bordered mb-0">

            <thead>

                <tr>

                    <th width="140">Kode</th>

                    <th>Nama</th>

                    <th width="170">Paket</th>

                    <th width="140">ONT</th>

                    <th width="120">Status</th>

                    <th width="220">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($customers as $customer)

                <tr>

                    <td>

                        <strong>

                            {{ $customer->customer_code }}

                        </strong>

                    </td>

                    <td>

                        {{ $customer->name }}

                    </td>

                    <td>

                        {{ $customer->package?->name ?? '-' }}

                    </td>

                    <td>

                        {{ $customer->ont?->code ?? 'Belum Dipasang' }}

                    </td>

                    <td>

                        <span class="badge badge-{{ $customer->badgeClass() }}">

                            {{ $customer->statusText() }}

                        </span>

                    </td>

                    <td>

                        <a href="{{ route('customers.show', $customer) }}"
                           class="btn btn-info btn-sm">

                            <i class="fas fa-eye"></i>

                            Detail

                        </a>

                        <a href="{{ route('customers.edit', $customer) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                            Edit

                        </a>

                        <form
                            action="{{ route('customers.destroy', $customer) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus pelanggan ini?')">

                                <i class="fas fa-trash"></i>

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        Belum ada data pelanggan.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop