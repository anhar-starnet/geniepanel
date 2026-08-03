@extends('adminlte::page')

@section('title', 'Tambah ONT')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Tambah Inventory ONT</h1>

    <a href="{{ route('onts.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Kembali

    </a>

</div>

@stop

@section('content')

<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">

            Data Inventory ONT

        </h3>

    </div>

    <form action="{{ route('onts.store') }}" method="POST">

        <div class="card-body">

            @include('onts._form')

        </div>

    </form>

</div>

@stop