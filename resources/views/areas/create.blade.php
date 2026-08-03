@extends('adminlte::page')

@section('title','Tambah Area')

@section('content_header')
<h1>Tambah Area</h1>
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

        <form action="{{ route('areas.store') }}" method="POST">

            @csrf

            @include('areas._form')

        </form>

    </div>

</div>

@stop