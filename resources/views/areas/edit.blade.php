@extends('adminlte::page')

@section('title','Edit Area')

@section('content_header')
<h1>Edit Area</h1>
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

        <form action="{{ route('areas.update',$area) }}" method="POST">

            @csrf
            @method('PUT')

            @include('areas._form')

        </form>

    </div>

</div>

@stop