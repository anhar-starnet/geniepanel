@extends('adminlte::page')

@section('title', 'Tambah ODP')

@section('content_header')
<h1>Tambah ODP</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('odps.store') }}" method="POST">

            @include('odps._form')

        </form>

    </div>

</div>

@stop