@csrf

@if ($errors->any())
<div class="alert alert-danger">

    <strong>Terjadi kesalahan!</strong>

    <ul class="mb-0 mt-2">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>
@endif

<div class="row">

    <div class="col-md-6 mb-3">

        <label>Kode ODP</label>

        <input
            type="text"
            name="code"
            class="form-control"
            value="{{ old('code', $odp->code ?? $odpCode ?? '') }}"
            readonly>

    </div>

    <div class="col-md-6 mb-3">

        <label>POP</label>

        <select
            name="pop_id"
            class="form-control"
            required>

            <option value="">-- Pilih POP --</option>

            @foreach($pops as $pop)

                <option
                    value="{{ $pop->id }}"
                    @selected(old('pop_id', $odp->pop_id ?? '') == $pop->id)>

                    {{ $pop->code }} - {{ $pop->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label>Nama ODP</label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $odp->name ?? '') }}"
            required>

    </div>

    <div class="col-md-6 mb-3">

        <label>Tipe Distribusi</label>

        <select
            name="distribution_type"
            class="form-control">

            <option
                value="AERIAL"
                @selected(old('distribution_type', $odp->distribution_type ?? 'AERIAL') == 'AERIAL')>

                AERIAL

            </option>

            <option
                value="UNDERGROUND"
                @selected(old('distribution_type', $odp->distribution_type ?? '') == 'UNDERGROUND')>

                UNDERGROUND

            </option>

        </select>

    </div>

    <div class="col-md-4 mb-3">

        <label>Kapasitas Port</label>

        <input
            type="number"
            name="port_capacity"
            class="form-control"
            value="{{ old('port_capacity', $odp->port_capacity ?? 16) }}">

    </div>

    <div class="col-md-4 mb-3">

        <label>Port Terpakai</label>

        <input
            type="number"
            name="used_ports"
            class="form-control"
            value="{{ old('used_ports', $odp->used_ports ?? 0) }}">

    </div>

    <div class="col-md-4 mb-3">

        <label>Core Fiber</label>

        <input
            type="text"
            name="fiber_core"
            class="form-control"
            value="{{ old('fiber_core', $odp->fiber_core ?? '') }}">

    </div>

    <div class="col-md-12 mb-3">

        <label>Alamat</label>

        <textarea
            name="address"
            rows="3"
            class="form-control">{{ old('address', $odp->address ?? '') }}</textarea>

    </div>

    <div class="col-md-6 mb-3">

        <label>Latitude</label>

        <input
            type="text"
            name="latitude"
            class="form-control"
            value="{{ old('latitude', $odp->latitude ?? '') }}">

    </div>

    <div class="col-md-6 mb-3">

        <label>Longitude</label>

        <input
            type="text"
            name="longitude"
            class="form-control"
            value="{{ old('longitude', $odp->longitude ?? '') }}">

    </div>

    <div class="col-md-12 mb-3">

        <label>Keterangan</label>

        <textarea
            name="description"
            rows="3"
            class="form-control">{{ old('description', $odp->description ?? '') }}</textarea>

    </div>

    <div class="col-md-6 mb-3">

        <label>Status</label>

        <select
            name="status"
            class="form-control">

            <option
                value="1"
                @selected(old('status', $odp->status ?? true)==1)>

                Aktif

            </option>

            <option
                value="0"
                @selected(old('status', $odp->status ?? true)==0)>

                Non Aktif

            </option>

        </select>

    </div>

</div>

<button class="btn btn-success">

    <i class="fas fa-save"></i>

    Simpan

</button>

<a
    href="{{ route('odps.index') }}"
    class="btn btn-secondary">

    Kembali

</a>