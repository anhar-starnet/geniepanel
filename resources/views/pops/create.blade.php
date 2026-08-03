@extends('adminlte::page')

@section('title', 'Tambah POP')

@section('content_header')
<h1>Tambah POP</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('pops.store') }}" method="POST">

            @include('pops._form')

        </form>

    </div>

</div>

@stop