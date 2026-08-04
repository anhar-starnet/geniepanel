<div class="card">

    <div class="card-body text-center">

        <a href="{{ route('genieacs.devices.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <button
            class="btn btn-primary"
            disabled>

            <i class="fas fa-sync"></i>

            Refresh

        </button>

        <button
            class="btn btn-warning"
            disabled>

            <i class="fas fa-redo"></i>

            Reboot

        </button>

        <button
            class="btn btn-danger"
            disabled>

            <i class="fas fa-power-off"></i>

            Factory Reset

        </button>

        @if(!$customer)

            <a href="{{ route('customers.create', [
                'serial' => $device->serialNumber,
                'pppoe' => $device->pppoeUsername,
            ]) }}"
               class="btn btn-success">

                <i class="fas fa-user-plus"></i>

                Create Customer

            </a>

        @else

            <a href="{{ route('customers.show', $customer) }}"
               class="btn btn-info">

                <i class="fas fa-user"></i>

                Customer

            </a>

        @endif

    </div>

</div>