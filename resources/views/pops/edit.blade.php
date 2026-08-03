@extends('adminlte::page')

@section('title', 'Edit POP')

@section('content_header')
<h1>Edit POP</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('pops.update',$pop) }}" method="POST">

            @method('PUT')

            @include('pops._form')

        </form>

    </div>

</div>

@stop