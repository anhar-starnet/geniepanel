<div class="row">

    <div class="col-md-4 mb-3">
        <label>Kode Area</label>
        <input type="text"
               name="code"
               class="form-control"
               value="{{ old('code', $area->code ?? $areaCode ?? '') }}"
               readonly>
    </div>

    <div class="col-md-8 mb-3">
        <label>Nama Area</label>
        <input type="text"
               name="name"
               class="form-control"
               value="{{ old('name', $area->name ?? '') }}"
               required>
    </div>

    <div class="col-md-6 mb-3">
        <label>PIC</label>
        <input type="text"
               name="pic"
               class="form-control"
               value="{{ old('pic', $area->pic ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>Nomor HP PIC</label>
        <input type="text"
               name="phone"
               class="form-control"
               value="{{ old('phone', $area->phone ?? '') }}">
    </div>

    <div class="col-md-12 mb-3">
        <label>Alamat</label>
        <textarea
            name="address"
            rows="3"
            class="form-control">{{ old('address', $area->address ?? '') }}</textarea>
    </div>

    <div class="col-md-3 mb-3">
        <label>Latitude</label>
        <input type="text"
               name="latitude"
               class="form-control"
               value="{{ old('latitude', $area->latitude ?? '') }}">
    </div>

    <div class="col-md-3 mb-3">
        <label>Longitude</label>
        <input type="text"
               name="longitude"
               class="form-control"
               value="{{ old('longitude', $area->longitude ?? '') }}">
    </div>

    <div class="col-md-3 mb-3">
        <label>Status</label>

        <select name="status" class="form-control">

            <option value="1"
                {{ old('status', $area->status ?? 1) == 1 ? 'selected' : '' }}>
                Aktif
            </option>

            <option value="0"
                {{ old('status', $area->status ?? 1) == 0 ? 'selected' : '' }}>
                Non Aktif
            </option>

        </select>

    </div>

</div>

<hr>

<button class="btn btn-success">
    <i class="fas fa-save"></i>
    Simpan
</button>

<a href="{{ route('areas.index') }}" class="btn btn-secondary">
    Batal
</a>