<div class="card card-dark">

    <div class="card-header">

        <h3 class="card-title">
            <i class="fas fa-chart-line"></i>
            GenieACS Live
        </h3>

    </div>

    <div class="card-body p-0">

        <table class="table table-bordered mb-0">

            @if($live)

                <tr>
                    <th width="180">Status ONU</th>
                    <td>
                        @if($live['online'])
                            <span class="badge badge-success">Online</span>
                        @else
                            <span class="badge badge-danger">Offline</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Vendor</th>
                    <td>{{ $live['manufacturer'] }}</td>
                </tr>

                <tr>
                    <th>Model</th>
                    <td>{{ $live['productClass'] }}</td>
                </tr>

                <tr>
                    <th>Serial Number</th>
                    <td>{{ $live['serialNumber'] }}</td>
                </tr>

                <tr>
                    <th>Firmware</th>
                    <td>{{ $live['firmware'] ?: '-' }}</td>
                </tr>

                <tr>
                    <th>RX Power</th>
                    <td>
                        <span class="badge badge-{{ $live['rxColor'] }}">
                            {{ $live['rx'] ?: '-' }} dBm
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Temperature</th>
                    <td>{{ $live['temperature'] ?: '-' }} °C</td>
                </tr>

                <tr>
                    <th>Uptime</th>
                    <td>{{ $live['uptime'] ?: '-' }}</td>
                </tr>

                <tr>
                    <th>PPPoE IP</th>
                    <td>{{ $live['pppoeIP'] ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Last Inform</th>
                    <td>{{ $live['lastInform'] }}</td>
                </tr>

            @else

                <tr>
                    <td colspan="2" class="text-center text-muted">
                        Device GenieACS tidak ditemukan.
                    </td>
                </tr>

            @endif

        </table>

    </div>

</div>