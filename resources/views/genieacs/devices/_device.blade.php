<div class="card card-primary card-outline">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-router"></i>

            Device Information

        </h3>

    </div>

    <div class="card-body p-0">

        <table class="table table-striped table-sm mb-0">

            <tbody>

                <tr>
                    <th width="35%">Vendor</th>
                    <td>{{ $device->manufacturer ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Model</th>
                    <td>{{ $device->productClass ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Serial Number</th>
                    <td>
                        <code>{{ $device->serialNumber ?: '-' }}</code>
                    </td>
                </tr>

                <tr>
                    <th>Firmware</th>
                    <td>{{ $device->firmware ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Hardware</th>
                    <td>{{ $device->hardware ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Device ID</th>
                    <td>
                        <small>{{ $device->id }}</small>
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

                    <th>Tags</th>

                    <td>

                        @forelse($device->tags as $tag)

                            <span class="badge badge-secondary">

                                {{ $tag }}

                            </span>

                        @empty

                            <span class="text-muted">

                                -

                            </span>

                        @endforelse

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>