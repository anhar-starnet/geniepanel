<div class="card card-primary card-outline">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-heartbeat text-danger"></i>

            Device Health

        </h3>

    </div>

    <div class="card-body">

        <div class="text-center mb-4">

            <h1 class="font-weight-bold">

                {{ $device->healthScore() }}

            </h1>

            <span class="badge badge-{{ $device->healthBadgeClass() }}">

                {{ $device->healthStatus() }}

            </span>

        </div>

        <div class="progress mb-4" style="height:18px;">

            <div
                class="progress-bar bg-{{ $device->healthBadgeClass() }}"
                role="progressbar"
                style="width: {{ $device->healthScore() }}%;">

                {{ $device->healthScore() }}%

            </div>

        </div>

        <table class="table table-sm">

            <tbody>

                <tr>

                    <th width="45%">

                        <i class="fas fa-globe text-primary"></i>

                        Status

                    </th>

                    <td>

                        <span class="badge badge-{{ $device->onlineBadgeClass() }}">

                            {{ $device->onlineLabel() }}

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>

                        <i class="fas fa-signal text-success"></i>

                        RX Power

                    </th>

                    <td>

                        <span class="badge badge-{{ $device->rxBadgeClass() }}">

                            {{ $device->rxLabel() }}

                        </span>

                    </td>

                </tr>

                <tr>

                    <td colspan="2">

                        <div class="progress" style="height:10px;">

                            <div
                                class="progress-bar bg-{{ $device->rxBadgeClass() }}"
                                role="progressbar"
                                style="width: {{ $device->rxPercentage() }}%;">

                            </div>

                        </div>

                    </td>

                </tr>

                <tr>

                    <th>

                        <i class="fas fa-temperature-half text-warning"></i>

                        Temperature

                    </th>

                    <td>

                        <span class="badge badge-{{ $device->temperatureBadgeClass() }}">

                            {{ $device->temperature }} °C

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>

                        <i class="fas fa-clock text-info"></i>

                        Last Inform

                    </th>

                    <td>

                        <span class="badge badge-{{ $device->lastInformBadgeClass() }}">

                            {{ $device->lastInformHuman() }}

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>

                        <i class="fas fa-history text-secondary"></i>

                        Uptime

                    </th>

                    <td>

                        {{ $device->uptime ?: '-' }}

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>