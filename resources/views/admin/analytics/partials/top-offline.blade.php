<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Top Offline ONU
        </h3>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover">

            <thead>

            <tr>

                <th>Serial Number</th>

                <th>Total Offline</th>

            </tr>

            </thead>

            <tbody>

            @forelse($analytics['topOffline'] as $item)

                <tr>

                    <td>{{ $item->serial_number }}</td>

                    <td>{{ $item->total }}</td>

                </tr>

            @empty

                <tr>

                    <td colspan="2" class="text-center">

                        Tidak ada data

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>