<div class="card card-info card-outline">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-network-wired"></i>

            Network & Optical

        </h3>

    </div>

    <div class="card-body p-0">

        <table class="table table-striped table-sm mb-0">

            <tbody>

                <tr>
                    <th width="35%">PPPoE Username</th>
                    <td>
                        <code>{{ $device->pppoeUsername ?: '-' }}</code>
                    </td>
                </tr>

                <tr>
                    <th>PPPoE IP</th>
                    <td>
                        <code>{{ $device->pppoeIP ?: '-' }}</code>
                    </td>
                </tr>

                <tr>

                    <th>RX Power</th>

                    <td>

                        <span class="badge badge-{{ $device->rxBadgeClass() }}">

                            {{ $device->rxLabel() }}

                        </span>

                        <div class="progress mt-2" style="height:8px;">

                            <div
                                class="progress-bar bg-{{ $device->rxBadgeClass() }}"
                                style="width: {{ $device->rxPercentage() }}%">
                            </div>

                        </div>

                    </td>

                </tr>

                <tr>

                    <th>Temperature</th>

                    <td>

                        <span class="badge badge-{{ $device->temperatureBadgeClass() }}">

                            {{ $device->temperature ?: '-' }} °C

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>Status</th>

                    <td>

                        <span class="badge badge-{{ $device->onlineBadgeClass() }}">

                            {{ $device->onlineLabel() }}

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>Last Inform</th>

                    <td>

                        <span class="badge badge-{{ $device->lastInformBadgeClass() }}">

                            {{ $device->lastInformHuman() }}

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>Uptime</th>

                    <td>

                        {{ $device->uptime ?: '-' }}

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>