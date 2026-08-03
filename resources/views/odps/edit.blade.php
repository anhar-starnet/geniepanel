@extends('adminlte::page')

@section('title', 'Edit ODP')

@section('content_header')
<h1>Edit ODP</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('odps.update', $odp) }}" method="POST">

            @csrf
            @method('PUT')

            @include('odps._form')

        </form>

    </div>

</div>

@stop