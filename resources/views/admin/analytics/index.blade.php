@extends('adminlte::page')

@section('title', 'Dashboard Analytics')

@section('content')

<div class="container-fluid">

    @include('admin.analytics.partials.cards')

    @include('admin.analytics.partials.charts')

    @include('admin.analytics.partials.top-offline')

    @include('admin.analytics.partials.alarms')

</div>

@endsection

@push('js')
    @include('admin.analytics.partials.refresh')
@endpush