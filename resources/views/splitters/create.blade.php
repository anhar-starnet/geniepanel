@extends('adminlte::page')

@section('title', 'Tambah Splitter')

@section('content_header')
<h1>Tambah Splitter</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('splitters.store') }}" method="POST">

            @include('splitters._form')

        </form>

    </div>

</div>

@stop