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

        <label>Kode Splitter</label>

        <input
            type="text"
            name="code"
            class="form-control"
            value="{{ old('code', $splitter->code ?? $splitterCode ?? '') }}"
            readonly>

    </div>

    <div class="col-md-6 mb-3">

        <label>ODP</label>

        <select
            name="odp_id"
            class="form-control"
            required>

            <option value="">-- Pilih ODP --</option>

            @foreach($odps as $odp)

                <option
                    value="{{ $odp->id }}"
                    @selected(old('odp_id', $splitter->odp_id ?? '') == $odp->id)>

                    {{ $odp->code }} - {{ $odp->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label>Nama Splitter</label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $splitter->name ?? '') }}"
            required>

    </div>

    <div class="col-md-6 mb-3">

        <label>Ratio</label>

        <select
            name="ratio"
            class="form-control">

            @foreach(['1:2','1:4','1:8','1:16','1:32','1:64'] as $ratio)

                <option
                    value="{{ $ratio }}"
                    @selected(old('ratio', $splitter->ratio ?? '1:8') == $ratio)>

                    {{ $ratio }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-12 mb-3">

        <label>Keterangan</label>

        <textarea
            name="description"
            rows="3"
            class="form-control">{{ old('description', $splitter->description ?? '') }}</textarea>

    </div>

    <div class="col-md-6 mb-3">

        <label>Status</label>

        <select
            name="status"
            class="form-control">

            <option
                value="1"
                @selected(old('status', $splitter->status ?? true)==1)>

                Aktif

            </option>

            <option
                value="0"
                @selected(old('status', $splitter->status ?? true)==0)>

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
    href="{{ route('splitters.index') }}"
    class="btn btn-secondary">

    Kembali

</a>