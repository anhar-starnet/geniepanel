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

        <label>Kode POP</label>

        <input type="text"
               name="code"
               class="form-control"
               value="{{ old('code', $pop->code ?? $popCode ?? '') }}"
               readonly>

    </div>

    <div class="col-md-6 mb-3">

        <label>Area</label>

        <select name="area_id" class="form-control" required>

            <option value="">-- Pilih Area --</option>

            @foreach($areas as $area)

                <option value="{{ $area->id }}"
                    @selected(old('area_id', $pop->area_id ?? '') == $area->id)>

                    {{ $area->code }} - {{ $area->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label>Nama POP</label>

        <input type="text"
               name="name"
               class="form-control"
               value="{{ old('name', $pop->name ?? '') }}"
               required>

    </div>

    <div class="col-md-6 mb-3">

        <label>Status</label>

        <select name="status" class="form-control">

            <option value="1"
                @selected(old('status', $pop->status ?? true)==1)>
                Aktif
            </option>

            <option value="0"
                @selected(old('status', $pop->status ?? true)==0)>
                Non Aktif
            </option>

        </select>

    </div>

    <div class="col-md-12 mb-3">

        <label>Alamat</label>

        <textarea
            name="address"
            rows="3"
            class="form-control">{{ old('address', $pop->address ?? '') }}</textarea>

    </div>

    <div class="col-md-6 mb-3">

        <label>Latitude</label>

        <input type="text"
               name="latitude"
               class="form-control"
               value="{{ old('latitude', $pop->latitude ?? '') }}">

    </div>

    <div class="col-md-6 mb-3">

        <label>Longitude</label>

        <input type="text"
               name="longitude"
               class="form-control"
               value="{{ old('longitude', $pop->longitude ?? '') }}">

    </div>

    <div class="col-md-12 mb-3">

        <label>Keterangan</label>

        <textarea
            name="description"
            rows="3"
            class="form-control">{{ old('description', $pop->description ?? '') }}</textarea>

    </div>

</div>

<button class="btn btn-success">

    <i class="fas fa-save"></i>

    Simpan

</button>

<a href="{{ route('pops.index') }}"
   class="btn btn-secondary">

    Kembali

</a>