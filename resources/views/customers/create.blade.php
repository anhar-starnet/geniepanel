@extends('adminlte::page')

@section('title', 'Tambah Pelanggan')

@section('content_header')
<h1>Tambah Pelanggan</h1>
@stop

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card">

    <div class="card-body">

        <form action="{{ route('customers.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Kode Pelanggan</label>
                    <input type="text"
                           class="form-control"
                           name="customer_code"
                           value="{{ old('customer_code', $customerCode) }}"
                           readonly>
                </div>

                <div class="col-md-8 mb-3">
                    <label>Nama Pelanggan</label>
                    <input type="text"
                           class="form-control"
                           name="name"
                           value="{{ old('name') }}"
                           required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>NIK</label>
                    <input type="text"
                           class="form-control"
                           name="nik"
                           value="{{ old('nik') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Nomor HP</label>
                    <input type="text"
                           class="form-control"
                           name="phone"
                           value="{{ old('phone') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Email</label>
                    <input type="email"
                           class="form-control"
                           name="email"
                           value="{{ old('email') }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Alamat</label>
                    <textarea class="form-control"
                              rows="3"
                              name="address">{{ old('address') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Paket Internet</label>

                    <select name="package_id" class="form-control">

                        <option value="">-- Pilih Paket --</option>

                        @foreach($packages as $package)

                            <option value="{{ $package->id }}"
                                {{ old('package_id') == $package->id ? 'selected' : '' }}>

                                {{ $package->name }}
                                ({{ $package->download_kbps/1000 }} Mbps)

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="active">Aktif</option>
                        <option value="suspend">Suspend</option>
                        <option value="terminated">Terminasi</option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">
                    <label>Username PPPoE</label>

                    <input type="text"
                           class="form-control"
                           name="pppoe_username"
                           value="{{ old('pppoe_username') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Password PPPoE</label>

                    <input type="text"
                           class="form-control"
                           name="pppoe_password"
                           value="{{ old('pppoe_password') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Serial Number ONT</label>

                    <input type="text"
                           class="form-control"
                           name="serial_number"
                           value="{{ old('serial_number') }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Latitude</label>

                    <input type="text"
                           class="form-control"
                           name="latitude"
                           value="{{ old('latitude') }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Longitude</label>

                    <input type="text"
                           class="form-control"
                           name="longitude"
                           value="{{ old('longitude') }}">
                </div>

            </div>

            <hr>

            <button class="btn btn-success">

                <i class="fas fa-save"></i>

                Simpan

            </button>

            <a href="{{ route('customers.index') }}"
               class="btn btn-secondary">

                Batal

            </a>

        </form>

    </div>

</div>

@stop