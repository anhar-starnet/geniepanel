@extends('adminlte::page')

@section('title', 'Aktivasi Customer')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Aktivasi Customer</h1>

    <a href="{{ route('customers.show', $customer) }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Kembali

    </a>

</div>

@stop

@section('content')

<form
    action="{{ route('customers.activate.store', $customer) }}"
    method="POST">

    @csrf

    <div class="row">

        <div class="col-md-6">

            <div class="card card-primary">

                <div class="card-header">

                    <h3 class="card-title">

                        Data Customer

                    </h3>

                </div>

                <div class="card-body">

                    <div class="form-group">

                        <label>Customer</label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $customer->customer_code }} - {{ $customer->name }}"
                            readonly>

                    </div>

                    <div class="form-group">

                        <label>Paket Internet</label>

                        <select
                            name="package_id"
                            class="form-control">

                            <option value="">-- Pilih Paket --</option>

                            @foreach($packages as $package)

                                <option
                                    value="{{ $package->id }}"
                                    @selected($customer->package_id == $package->id)>

                                    {{ $package->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label>ONT</label>

                        <select
                            name="ont_id"
                            class="form-control">

                            <option value="">-- Pilih ONT --</option>

                            @foreach($onts as $ont)

                                <option
                                    value="{{ $ont->id }}"
                                    @selected($customer->ont_id == $ont->id)>

                                    {{ $ont->code }}
                                    -
                                    {{ $ont->vendor }}
                                    {{ $ont->model }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card card-info">

                <div class="card-header">

                    <h3 class="card-title">

                        PPPoE

                    </h3>

                </div>

                <div class="card-body">

                    <div class="form-group">

                        <label>Username</label>

                        <input
                            type="text"
                            name="pppoe_username"
                            class="form-control"
                            value="{{ old('pppoe_username', $customer->pppoe_username) }}">

                    </div>

                    <div class="form-group">

                        <label>Password</label>

                        <input
                            type="text"
                            name="pppoe_password"
                            class="form-control"
                            value="{{ old('pppoe_password', $customer->pppoe_password) }}">

                    </div>

                </div>

            </div>

        </div>

    </div>

    <button
        class="btn btn-success">

        <i class="fas fa-check-circle"></i>

        Aktivasi Customer

    </button>

</form>

@stop