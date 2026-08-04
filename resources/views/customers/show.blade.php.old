@extends('adminlte::page')

@section('title', 'Detail Customer')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Detail Customer</h1>

    <a href="{{ route('customers.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Kembali

    </a>

</div>

@stop

@section('content')

<div class="row">

    <div class="col-md-6">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    Informasi Customer

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>
                    <th width="180">Kode</th>
                    <td>{{ $customer->customer_code }}</td>
                </tr>

                <tr>
                    <th>Nama</th>
                    <td>{{ $customer->name }}</td>
                </tr>

                <tr>
                    <th>NIK</th>
                    <td>{{ $customer->nik ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Telepon</th>
                    <td>{{ $customer->phone ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $customer->email ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>{{ $customer->address ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>

                        <span class="badge badge-{{ $customer->badgeClass() }}">

                            {{ $customer->statusText() }}

                        </span>

                    </td>

                </tr>

            </table>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card card-info">

            <div class="card-header">

                <h3 class="card-title">

                    Layanan

                </h3>

            </div>

            <table class="table table-bordered mb-0">

                <tr>
                    <th width="180">Paket</th>

                    <td>

                        {{ $customer->package?->name ?? '-' }}

                    </td>

                </tr>

                <tr>
                    <th>ONT</th>

                    <td>

                        {{ $customer->ont?->code ?? '-' }}

                    </td>

                </tr>

                <tr>
                    <th>PPPoE Username</th>

                    <td>

                        {{ $customer->pppoe_username ?: '-' }}

                    </td>

                </tr>

                <tr>
                    <th>PPPoE Password</th>

                    <td>

                        {{ $customer->pppoe_password ?: '-' }}

                    </td>

                </tr>

                <tr>
                    <th>POP</th>

                    <td>

                        {{ $customer->pop?->name ?? '-' }}

                    </td>

                </tr>

                <tr>
                    <th>ODP</th>

                    <td>

                        {{ $customer->odp?->name ?? '-' }}

                    </td>

                </tr>

            </table>

        </div>

    </div>

</div>

<div class="mt-3">

    <a href="{{ route('customers.activate', $customer) }}"
   class="btn btn-primary">

    <i class="fas fa-play-circle"></i>

    Aktivasi

</a>
    <a href="{{ route('customers.edit', $customer) }}"
       class="btn btn-warning">

        <i class="fas fa-edit"></i>

        Ubah

    </a>

    @if($customer->ont)

        <a href="{{ route('onts.show', $customer->ont) }}"
           class="btn btn-success">

            <i class="fas fa-network-wired"></i>

            Detail ONT

        </a>

    @endif

</div>

@stop