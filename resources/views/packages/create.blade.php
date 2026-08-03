@extends('adminlte::page')

@section('title', 'Tambah Paket')

@section('content_header')
    <h1>Tambah Paket Internet</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('packages.store') }}" method="POST">

            @csrf

            @include('packages._form')

            <button class="btn btn-success">
                <i class="fas fa-save"></i> Simpan
            </button>

            <a href="{{ route('packages.index') }}" class="btn btn-secondary">
                Batal
            </a>

        </form>

    </div>

</div>

@stop