@extends('adminlte::page')

@section('title', 'Edit Splitter')

@section('content_header')
<h1>Edit Splitter</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('splitters.update', $splitter) }}" method="POST">

            @csrf
            @method('PUT')

            @include('splitters._form')

        </form>

    </div>

</div>

@stop