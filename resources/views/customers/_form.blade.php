@extends('adminlte::page')

@section('title','Edit Pelanggan')

@section('content_header')
<h1>Edit Pelanggan</h1>
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

        <form action="{{ route('customers.update',$customer) }}" method="POST">

            @csrf
            @method('PUT')

            @include('customers._form')

        </form>

    </div>

</div>

@stop