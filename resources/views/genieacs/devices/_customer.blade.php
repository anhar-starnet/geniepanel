<div class="card card-success card-outline">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-user"></i>

            Customer Information

        </h3>

    </div>

    <div class="card-body p-0">

        @if($customer)

        <table class="table table-striped table-sm mb-0">

            <tbody>

                <tr>
                    <th width="35%">Customer</th>
                    <td>{{ $customer->name }}</td>
                </tr>

                <tr>
                    <th>Kode</th>
                    <td>{{ $customer->customer_code }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge badge-{{ $customer->badgeClass() }}">
                            {{ $customer->statusText() }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Service</th>
                    <td>{{ $customer->serviceTypeText() }}</td>
                </tr>

                <tr>
                    <th>Paket</th>
                    <td>{{ $customer->package?->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>POP</th>
                    <td>{{ $customer->pop?->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>ODP</th>
                    <td>{{ $customer->odp?->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Area</th>
                    <td>{{ $customer->area()?->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Splitter</th>
                    <td>{{ $customer->splitter()?->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Port</th>
                    <td>{{ $customer->splitterPort()?->port_number ?? '-' }}</td>
                </tr>

                <tr>
                    <th>ONT</th>
                    <td>{{ $customer->ont?->code ?? '-' }}</td>
                </tr>

                <tr>
                    <th>PPPoE</th>
                    <td>
                        <code>{{ $customer->pppoe_username }}</code>
                    </td>
                </tr>

            </tbody>

        </table>

        <div class="card-footer text-right">

            <a href="{{ route('customers.show', $customer) }}"
               class="btn btn-primary">

                <i class="fas fa-eye"></i>

                Detail Customer

            </a>

        </div>

        @else

        <div class="callout callout-warning m-3">

            <h5>

                <i class="fas fa-exclamation-triangle"></i>

                Device Belum Terhubung ke Customer

            </h5>

            <p class="mb-3">

                Device ini sudah terdaftar di GenieACS tetapi belum
                mempunyai data pelanggan pada GeniePanel.

            </p>

            <a href="{{ route('customers.create', ['device' => $device->id]) }}"
               class="btn btn-success">

                <i class="fas fa-user-plus"></i>

                Create Customer

            </a>

        </div>

        @endif

    </div>

</div>