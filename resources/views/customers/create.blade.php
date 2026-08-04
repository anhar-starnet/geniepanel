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

<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user-plus"></i>
            Form Pelanggan Baru
        </h3>
    </div>

    <form action="{{ route('customers.store') }}" method="POST">

        @csrf

        <div class="card-body">

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label>Kode Customer</label>

                    <input
                        type="text"
                        name="customer_code"
                        class="form-control"
                        value="{{ old('customer_code', $customerCode) }}"
                        readonly>
                </div>

                <div class="col-md-9 mb-3">
                    <label>Nama Customer</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>NIK</label>

                    <input
                        type="text"
                        name="nik"
                        class="form-control"
                        value="{{ old('nik') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Nomor HP</label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Alamat</label>

                    <textarea
                        name="address"
                        rows="3"
                        class="form-control">{{ old('address') }}</textarea>
                </div>

                <div class="col-md-4 mb-3">

                    <label>Jenis Layanan</label>

                    <select
                        name="service_type"
                        id="service_type"
                        class="form-control">

                        <option value="PPPOE"
                            {{ old('service_type','PPPOE')=='PPPOE'?'selected':'' }}>
                            PPPoE
                        </option>

                        <option value="STATIC"
                            {{ old('service_type')=='STATIC'?'selected':'' }}>
                            Static IP
                        </option>

                        <option value="HOTSPOT"
                            {{ old('service_type')=='HOTSPOT'?'selected':'' }}>
                            Hotspot
                        </option>

                    </select>

                </div>

                <div class="col-md-8 mb-3">

                    <label>Paket Internet</label>

                    <select
                        name="package_id"
                        class="form-control">

                        <option value="">-- Pilih Paket --</option>

                        @foreach($packages as $package)

                            <option
                                value="{{ $package->id }}"
                                {{ old('package_id')==$package->id?'selected':'' }}>

                                {{ $package->name }}
                                ({{ $package->download_kbps/1000 }} Mbps)

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>
             @if(isset($device))

<hr>

<h5>
    <i class="fas fa-wifi"></i>
    Data GenieACS
</h5>

<div class="row">

    <div class="col-md-6 mb-3">
        <label>Serial Number</label>

        <input
            type="text"
            class="form-control"
            name="serial_number"
            value="{{ old('serial_number', $device->serialNumber) }}"
            readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label>Device ID</label>

        <input
            type="text"
            class="form-control"
            value="{{ $device->id }}"
            readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label>Vendor</label>

        <input
            type="text"
            class="form-control"
            value="{{ $device->manufacturer }}"
            readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label>Model</label>

        <input
            type="text"
            class="form-control"
            value="{{ $device->productClass }}"
            readonly>
    </div>

</div>

@endif
            <hr>

            <h5>
                <i class="fas fa-key"></i>
                Authentication
            </h5>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label id="lbl_username">

                        Username

                    </label>

                    <input
                        type="text"
                        name="pppoe_username"
                        class="form-control"
                        value="{{ old('pppoe_username', $device->pppoeUsername ?? '') }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label id="lbl_password">

                        Password

                    </label>

                    <input
                        type="text"
                        name="pppoe_password"
                        class="form-control"
                        value="{{ old('pppoe_password') }}">

                </div>

            </div>

            <hr>

            <h5>
                <i class="fas fa-map-marker-alt"></i>
                Lokasi
            </h5>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Latitude</label>

                    <input
                        type="text"
                        name="latitude"
                        class="form-control"
                        value="{{ old('latitude') }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Longitude</label>

                    <input
                        type="text"
                        name="longitude"
                        class="form-control"
                        value="{{ old('longitude') }}">

                </div>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan

            </button>

            <a href="{{ route('customers.index') }}"
               class="btn btn-secondary">

                Batal

            </a>

        </div>

    </form>

</div>

@stop

@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const service = document.getElementById('service_type');
    const lblUser = document.getElementById('lbl_username');
    const lblPass = document.getElementById('lbl_password');

    function refreshLabel() {

        switch (service.value) {

            case 'STATIC':

                lblUser.innerText = 'IP Address';
                lblPass.innerText = 'Gateway';

                break;

            case 'HOTSPOT':

                lblUser.innerText = 'Username Hotspot';
                lblPass.innerText = 'Password Hotspot';

                break;

            default:

                lblUser.innerText = 'Username PPPoE';
                lblPass.innerText = 'Password PPPoE';

        }

    }

    service.addEventListener('change', refreshLabel);

    refreshLabel();

});

</script>

@stop