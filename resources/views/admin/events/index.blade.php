@extends('adminlte::page')

@section('title', 'Device Events')

@section('content_header')
<h1>Device Event Timeline</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Latest 100 Events

        </h3>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover">

            <thead>

            <tr>

                <th>Time</th>

                <th>Severity</th>

                <th>PPPoE</th>

                <th>Event</th>

                <th>Reason</th>

                <th>Confidence</th>

            </tr>

            </thead>

            <tbody>

            @forelse($events as $event)

                <tr>

                    <td>

                        {{ $event->created_at }}

                    </td>

                    <td>

                        @switch($event->severity)

                            @case('critical')
                                <span class="badge bg-danger">
                                    Critical
                                </span>
                                @break

                            @case('warning')
                                <span class="badge bg-warning">
                                    Warning
                                </span>
                                @break

                            @case('success')
                                <span class="badge bg-success">
                                    Success
                                </span>
                                @break

                            @default
                                <span class="badge bg-info">
                                    Info
                                </span>

                        @endswitch

                    </td>

                    <td>

                        <strong>

                            {{ $event->pppoe_username ?? '-' }}

                        </strong>

                        <br>

                        <small class="text-muted">

                            {{ $event->serial_number }}

                        </small>

                    </td>

                    <td>

                        {{ ucfirst($event->event) }}

                    </td>

                    <td>

                        {{ $event->reason ?? '-' }}

                    </td>

                    <td>

                        {{ $event->confidence }}%

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        No events.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop