@extends('adminlte::page')

@section('title', 'Dashboard Analytics')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h3>Dashboard Analytics</h3>
        </div>

        <div class="card-body">

            <pre>{{ json_encode($analytics, JSON_PRETTY_PRINT) }}</pre>

        </div>
    </div>

</div>
@endsection