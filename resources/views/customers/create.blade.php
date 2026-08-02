@extends('adminlte::page')

@section('title', 'Tambah Pelanggan')

@section('content_header')
    <h1>Tambah Pelanggan</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label>Kode Pelanggan</label>
                <input type="text" name="customer_code" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Nomor HP</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Alamat</label>
                <textarea name="address" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="Suspend">Suspend</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@stop
