@extends('adminlte::page')

@section('title', 'Detail Device')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>

        <i class="fas fa-router mr-2"></i>

        Detail Device

    </h1>

    <a href="{{ route('genieacs.devices.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Kembali

    </a>

</div>

@stop

@section('content')

<div class="row">

    <div class="col-lg-4">

        @include('genieacs.devices._health')

    </div>

    <div class="col-lg-8">

        @include('genieacs.devices._device')

    </div>

</div>

<div class="row mt-3">

    <div class="col-lg-6">

        @include('genieacs.devices._customer')

    </div>

    <div class="col-lg-6">

        @include('genieacs.devices._network')

    </div>

</div>

<div class="row mt-3">

    <div class="col-12">

        @include('genieacs.devices._actions')

    </div>

</div>

@stop