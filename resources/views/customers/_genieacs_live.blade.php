<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chart-line"></i>
            GenieACS Live
        </h3>
    </div>

    <div class="card-body p-0">
        @if($live)

        <div class="p-3">
            <div class="row text-center">
                <div class="col-md-3 border-right">
                    <small class="text-muted d-block">STATUS</small>
                    <span class="badge badge-{{ $live['onlineBadge'] }}">{{ $live['onlineLabel'] }}</span>
                </div>

                <div class="col-md-3 border-right">
                    <small class="text-muted d-block">HEALTH</small>
                    <h4 class="mb-0">{{ $live['healthScore'] }}%</h4>
                    <span class="badge badge-{{ $live['healthBadge'] }}">{{ $live['healthStatus'] }}</span>
                </div>

                <div class="col-md-3 border-right">
                    <small class="text-muted d-block">RX POWER</small>
                    <h4 class="mb-0">{{ $live['rx'] ?: '-' }}</h4>
                    <small>dBm</small>
                </div>

                <div class="col-md-3">
                    <small class="text-muted d-block">TEMPERATURE</small>
                    <h4 class="mb-0">{{ $live['temperature'] ?: '-' }}°</h4>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-sm mb-0">
            <tr><th width="180">Status ONU</th><td><span class="badge badge-{{ $live['onlineBadge'] }}">{{ $live['onlineLabel'] }}</span></td></tr>
            <tr><th>Vendor</th><td>{{ $live['manufacturer'] }}</td></tr>
            <tr><th>Model</th><td>{{ $live['productClass'] }}</td></tr>
            <tr><th>Serial Number</th><td>{{ $live['serialNumber'] }}</td></tr>
            <tr><th>Firmware</th><td>{{ $live['firmware'] ?: '-' }}</td></tr>
            <tr>
                <th>RX Power</th>
                <td>
                    <span class="badge badge-{{ $live['rxBadge'] }}">{{ $live['rx'] ?: '-' }} dBm ({{ $live['rxStatus'] }})</span>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-{{ $live['rxColor'] }}" style="width: {{ $live['rxPercent'] }}%"></div>
                    </div>
                </td>
            </tr>
            <tr><th>Temperature</th><td><span class="badge badge-{{ $live['temperatureBadge'] }}">{{ $live['temperature'] ?: '-' }} °C ({{ $live['temperatureStatus'] }})</span></td></tr>
            <tr><th>Uptime</th><td>{{ $live['uptime'] ?: '-' }}</td></tr>
            <tr><th>PPPoE IP</th><td>{{ $live['pppoeIP'] ?: '-' }}</td></tr>
            <tr><th>Last Inform</th><td><span class="badge badge-{{ $live['lastInformBadge'] }}">{{ $live['lastInform'] }}</span></td></tr>
        </table>

        @else

        <div class="p-4 text-center text-muted">
            Device GenieACS tidak ditemukan.
        </div>

        @endif
    </div>
</div>
